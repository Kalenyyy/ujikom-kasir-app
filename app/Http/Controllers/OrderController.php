<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Member;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        // Logic to display all orders
        $products = Product::all();
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(8);
        return view('orders.index', compact('products', 'orders'));
    }

    public function showCheckout(Request $request)
    {
        // Ambil data produk dan quantity dari request
        $productIds = $request->input('product_ids', []);
        $quantities = $request->input('quantities', []);


        // Filter hanya produk dengan quantity lebih dari 0
        $checkoutProducts = [];
        foreach ($productIds as $productId) {
            if (!empty($quantities[$productId]) && $quantities[$productId] > 0) {
                $checkoutProducts[$productId] = $quantities[$productId];
            }
        }

        // Jika tidak ada produk yang valid, kembali ke halaman sebelumnya dengan pesan error
        if (empty($checkoutProducts)) {
            return redirect()->back()->with('error', 'Silakan pilih setidaknya satu produk dengan jumlah lebih dari 0.');
        }

        // Ambil detail produk dari database berdasarkan ID yang telah difilter
        $products = Product::whereIn('id', array_keys($checkoutProducts))->get();

        $totalPrice = 0;

        foreach ($products as $product) {
            $totalPrice += $product->price * ($checkoutProducts[$product->id] ?? 1);
        }

        // Return view checkout dengan data produk dan quantity
        return view('orders.checkout', compact('products', 'checkoutProducts', 'totalPrice'));
    }

    public function checkout(Request $request)
    {
        // Ambil array ID dari produk yang dikirim dalam request
        $productIds = collect($request->products)->pluck('id')->toArray();
        // Ambil data produk dari database berdasarkan ID
        $products = Product::whereIn('id', $productIds)->get();

        // Hitung total harga
        $totalPrice = 0;
        $totalBarang = 0;

        foreach ($products as $product) {
            $quantity = collect($request->products)->firstWhere('id', $product->id)['quantity'];
            $totalPrice += $product->price * $quantity;
            $totalBarang += $quantity;
        }

        // Bersihkan format "Rp" dari customer_pay
        $customerPay = preg_replace('/[^0-9]/', '', $request->input('total_bayar'));

        // Hitung kembalian (customer_return)
        $customerReturn = $customerPay - $totalPrice;
        $order = new Order();

        if ($request->input('member_status') == 'member') {
            // Cek apakah member sudah ada berdasarkan no_telp
            $member = Member::where('no_telp', $request->input('no_telp'))->first();

            if (!$member) {
                $member = Member::create([
                    'no_telp' => $request->input('no_telp'),
                ]);
            }

            // Simpan order ke session
            $orderData = [
                'products' => $products->map(function ($product) use ($request) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => collect($request->products)->firstWhere('id', $product->id)['quantity'],
                    ];
                })->toArray(),
                'members_id' => $member->id,
                'users_id' => Auth::user()->id,
                'tanggal_penjualan' => now()->setTimezone('Asia/Jakarta'),
                'total_barang' => $totalBarang,
                'total_harga' => $totalPrice,
                'customer_pay' => $customerPay,
                'customer_return' => $customerReturn,
                'no_telp' => $member->no_telp,
                'point' => $member->point ?? 0,
            ];
            // Pastikan name_customer masuk ke array meskipun kosong
            if (!empty($member->name_member)) {
                $orderData['name_customer'] = $member->name_member;
            }

            session(['checkout_member' => $orderData]);

            return redirect()->route('orders.show-checkout-member');
        }


        if ($request->input('member_status') == 'bukan-member') {
            $order->name_customer = 'Bukan Member';
            $order->products = json_encode($products->map(function ($product) use ($request) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => collect($request->products)->firstWhere('id', $product->id)['quantity'],
                ];
            }));
            $order->users_id = Auth::user()->id;
            $order->tanggal_penjualan = now()->setTimezone('Asia/Jakarta');;
            $order->total_barang = $totalBarang;
            $order->total_harga = $totalPrice;
            $order->customer_pay = $customerPay;
            $order->customer_return = $customerReturn;
            $order->save();

            foreach ($products as $product) {
                $quantity = collect($request->products)->firstWhere('id', $product->id)['quantity'];
                $product->stock -= $quantity;
                $product->save();
            }

            return redirect()->route('orders.detail-order', $order->id);
        }
    }

    public function showDetailOrder($id)
    {
        $order = Order::with('user', 'member')->findOrFail($id);

        // Ambil nilai session
        $pointUsed = $order->member_point_used;
        $originalTotalPrice = $order->total_harga;

        // Hapus session setelah digunakan
        session()->forget(['used_member_points', 'original_total_price']);

        $products = json_decode($order->products, true);

        return view('orders.detail-print', compact('order', 'products', 'pointUsed', 'originalTotalPrice'));
    }

    public function detailPrintOrder($id)
    {
        $order = Order::with('user', 'member')->findOrFail($id);
        $products = json_decode($order->products, true);

        return view('orders.page-detail-order', compact('order', 'products'));
    }

    public function showCheckoutMember()
    {
        // Ambil data dari session
        $orderData = session('checkout_member');

        if (!$orderData) {
            return redirect()->route('orders.index')->with('error', 'Tidak ada data checkout.');
        }

        $products = Product::whereIn('id', collect($orderData['products'])->pluck('id'))->get();

        return view('orders.checkout-member', [
            'products' => $products,
            'checkoutProducts' => collect($orderData['products'])->pluck('quantity', 'id')->toArray(),
            'totalPrice' => $orderData['total_harga'],
            'orderData' => $orderData
        ]);
    }

    public function storeOrderMember(Request $request)
    {
        // Ambil array ID dari produk yang dikirim dalam request
        $productIds = collect($request->products)->pluck('id')->toArray();
        // Ambil data produk dari database berdasarkan ID
        $products = Product::whereIn('id', $productIds)->get();

        // Hitung total harga awal (sebelum pengurangan poin)
        $originalTotalPrice = 0;
        $totalBarang = 0;

        foreach ($products as $product) {
            $quantity = collect($request->products)->firstWhere('id', $product->id)['quantity'];
            $originalTotalPrice += $product->price * $quantity;
            $totalBarang += $quantity;
        }

        // Buat variabel final harga yang akan diproses ke database
        $finalTotalPrice = $originalTotalPrice;

        // Bersihkan format "Rp" dari customer_pay
        $customerPay = preg_replace('/[^0-9]/', '', $request->input('customer_pay'));

        // Buat order baru
        $order = new Order();
        $order->products = json_encode($products->map(function ($product) use ($request) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => collect($request->products)->firstWhere('id', $product->id)['quantity'],
            ];
        }));
        $order->users_id = Auth::user()->id;
        $order->tanggal_penjualan = now()->setTimezone('Asia/Jakarta');
        $order->total_barang = $totalBarang;
        $order->total_harga = $originalTotalPrice;
        $order->customer_pay = $customerPay;
        $order->members_id = $request->input('member_id');

        // Ambil data member jika ada
        $member = Member::where('id', $order->members_id)->first();
        if ($member) {
            $member->update([
                'name_member' => $request->input('name_member')
            ]);
        }

        // **Cek apakah member menggunakan poin**
        $memberPointsUsed = 0;
        if ($member && $request->has('use_point')) {
            // Gunakan poin sebanyak mungkin tetapi tidak lebih dari total harga
            $memberPointsUsed = min($member->point, $originalTotalPrice);
            $finalTotalPrice -= $memberPointsUsed; // Kurangi harga dengan poin

            // Update poin member
            $member->point -= $memberPointsUsed;
            $member->save();

            // Simpan poin yang digunakan ke database
            $order->member_point_used = $memberPointsUsed;
        } else {
            // Jika tidak menggunakan poin, hitung poin baru yang diperoleh
            $pointsEarned = $originalTotalPrice * 0.01; // 1% dari total harga asli
            $member->point += $pointsEarned;
            $member->save();
        }

        // **Hitung ulang customer_return setelah pengurangan poin**
        $customerReturn = $customerPay - $finalTotalPrice;
        $order->customer_return = $customerReturn;

        // Simpan order ke database
        $order->total_harga_after_point = $finalTotalPrice;
        $order->save();

        // Update stok produk
        foreach ($products as $product) {
            $quantity = collect($request->products)->firstWhere('id', $product->id)['quantity'];
            $product->stock -= $quantity;
            $product->save();
        }

        return redirect()->route('orders.detail-order', $order->id);
    }

    public function generatePDF($id)
    {
        // Ambil data order berdasarkan ID
        $order = Order::with('user', 'member')->findOrFail($id);

        // Decode JSON produk dari database
        $products = json_decode($order->products, true);

        // Load view untuk PDF dan kirim data
        $pdf = app('dompdf.wrapper')->loadView('orders.order-detail-PDF', compact('order', 'products'));

        // Unduh atau tampilkan PDF di browser
        // return $pdf->stream('order.pdf'); // Menampilkan di browser
        return $pdf->download('order.pdf'); // Jika ingin langsung diunduh
    }

    public function exportOrders() {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
