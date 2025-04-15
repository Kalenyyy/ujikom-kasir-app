<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function dashboard()
    {
        $users_count = User::count();
        $products_count = Product::where('stock', '>', 0)->sum('stock'); // Menghitung total stok
        $orders_today = Order::whereDate('created_at', date('Y-m-d'))->count(); // Menghitung total order hari ini

        // Ambil semua order hari ini
        $orders = Order::whereDate('created_at', now()->toDateString())->get();

        // Total penjualan hari ini
        $total_penjualan_hari_ini = 0;

        foreach ($orders as $order) {
            $products = json_decode($order->products, true);
            foreach ($products as $product) {
                $total_penjualan_hari_ini += ((int) $product['price']) * ((int) $product['quantity']);
            }
        }

        // Tentukan rentang tanggal
        $today = now()->format('Y-m-d');
        $fourDaysBefore = now()->subDays(6)->format('Y-m-d');
        $threeDaysAfter = now()->addDays(1)->format('Y-m-d');

        // Ambil data penjualan dalam rentang tanggal yang ditentukan
        $salesData = Order::whereBetween('created_at', [$fourDaysBefore, $threeDaysAfter])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total_sales')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_sales', 'date')
            ->toArray();

        // Buat array tanggal lengkap dari rentang yang diinginkan
        $dates = [];
        $salesPerDay = [];
        for ($i = -6; $i <= 1; $i++) {
            $date = now()->addDays($i)->format('Y-m-d');
            $dates[] = $date;
            $salesPerDay[] = $salesData[$date] ?? 0; // Isi dengan 0 jika tidak ada data
        }

        // === Pie Chart Data ===
        $orders = Order::all();
        $productSales = [];

        foreach ($orders as $order) {
            $items = json_decode($order->products, true);
            foreach ($items as $item) {
                $name = $item['name'];
                $qty = (int) $item['quantity'];
                if (!isset($productSales[$name])) {
                    $productSales[$name] = 0;
                }
                $productSales[$name] += $qty;
            }
        }

        // Pisahkan menjadi dua array untuk chart.js
        $productLabels = array_keys($productSales);
        $productQuantities = array_values($productSales);


        return view('dashboard', compact(
            'users_count',
            'products_count',
            'orders_today',
            'dates',
            'salesPerDay',
            'productLabels',
            'productQuantities',
            'total_penjualan_hari_ini'
        ));
    }


    public function index()
    {
        // Ambil semua data user kecuali akun yang sedang login
        $users = User::where('id', '!=', auth()->id())->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required', // Validasi role
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
        ]);

        // Update data user
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Hapus user berdasarkan ID
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }

    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
