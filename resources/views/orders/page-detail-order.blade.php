@extends('layouts.template')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white rounded-2xl shadow-lg w-full max-w-3xl p-6">
            <div class="flex justify-between items-start border-b pb-4">
                <h2 class="text-xl font-semibold">Detail Penjualan</h2>
                <button onclick="" class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
            </div>

            <div class="mt-4 space-y-2">
                <div class="flex justify-between text-sm">
                    @if ($order->members_id != null)
                        <div>
                            <p><span class="font-semibold">Member Status:</span> {{ $order->member->name_member }}</p>
                            <p><span class="font-semibold">No. HP:</span> {{ $order->member->no_telp }}</p>
                            <p><span class="font-semibold">Poin Member:</span> {{ $order->member->point }}</p>
                        </div>
                        <div>
                            <p><span class="font-semibold">Bergabung Sejak:</span>
                                {{ \Carbon\Carbon::parse($order->member->created_at)->format('d M Y') }}</p>
                        </div>
                    @elseif($order->members_id == null)
                        <div>
                            <p><span class="font-semibold">Member Status:</span> {{ $order->name_customer }}</p>
                            <p><span class="font-semibold">No. HP:</span> -</p>
                            <p><span class="font-semibold">Poin Member:</span> 0</p>
                        </div>
                        <div>
                            <p><span class="font-semibold">Bergabung Sejak:</span> -</p>
                        </div>
                    @endif
                </div>

                <div class="mt-6">
                    <table class="w-full text-sm text-left border-t">
                        <thead>
                            <tr class="text-gray-700 font-semibold border-b">
                                <th class="py-2">Nama Produk</th>
                                <th class="py-2 text-center">Qty</th>
                                <th class="py-2 text-right">Harga</th>
                                <th class="py-2 text-right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            @foreach ($products as $product)
                                <tr class="border-b">
                                    <td class="py-2">{{ $product['name'] }}</td>
                                    <td class="py-2 text-center">{{ $product['quantity'] }}</td>
                                    <td class="py-2 text-right">Rp. {{ number_format($product['price'], 0, ',', '.') }}</td>
                                    <td class="py-2 text-right">
                                        {{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 space-y-1 text-sm">

                    @if ($order->members_id != null)
                        <div class="flex justify-between font-semibold">
                            <span>Total Belanja</span>
                            <span>Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Point Digunakan</span>
                            <span>
                                @if ($order->member_point_used > 0)
                                    {{ $order->member_point_used }}
                                @else
                                    Tidak ada poin yang digunakan
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span>Bayaran Pembeli</span>
                            <span>Rp. {{ number_format($order->customer_pay, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <span>Kembalian</span>
                            <span>Rp. {{ number_format($order->total_harga_after_point, 0, ',', '.') }}</span>
                        </div>
                    @elseif($order->members_id == null)
                        <div class="flex justify-between font-semibold">
                            <span>Total Belanja</span>
                            <span>Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Bayaran Pembeli</span>
                            <span>Rp. {{ number_format($order->customer_pay, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <span>Kembalian</span>
                            <span>Rp. {{ number_format($order->customer_return, 0, ',', '.') }}</span>
                        </div>
                    @endif

                </div>

                <div class="text-sm text-gray-500 mt-4">
                    <p>Dibuat pada: {{ $order->tanggal_penjualan }}</p>
                    <p>Oleh: {{ $order->user->name }}</p>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('orders.index') }}">
                    <button onclick=""
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium">Tutup</button>
                </a>
            </div>
        </div>
    </div>
@endsection
