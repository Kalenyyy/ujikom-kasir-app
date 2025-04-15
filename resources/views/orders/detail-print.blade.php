@extends('layouts.template')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center border-b pb-4">
            <div>
                @if ($order->member == !null)
                    <h2 class="text-lg font-semibold text-gray-800">{{ $order->member->no_telp }}</h2>
                    <p class="text-sm text-gray-500">MEMBER SEJAK:
                        {{ Carbon\Carbon::parse($order->member->created_at)->format('d F Y') }}</p>
                    <p class="text-sm text-gray-500">MEMBER POIN: {{ number_format($order->member->point, 0, ',', '.') }}
                        Point
                    </p>
                @endif
            </div>
            <div class="text-right">
                <p class="text-gray-500">Invoice - #{{ $order->id }}</p>
                <p class="font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($order->tanggal_penjualan)->locale('id')->translatedFormat('d F Y, H:i:s') }}
                    WIB
                </p>
            </div>
        </div>

        <div class="mt-4">
            <table class="w-full border-collapse rounded-lg overflow-hidden shadow-sm">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-3 px-4 text-left">Produk</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                        <th class="py-3 px-4 text-left">Quantity</th>
                        <th class="py-3 px-4 text-left">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-t bg-white hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $product['name'] }}</td>
                            <td class="py-3 px-4">Rp. {{ number_format($product['price'], 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $product['quantity'] }}</td>
                            <td class="py-3 px-4">Rp.
                                {{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="bg-gray-100 p-4 mt-4 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
                <p class="font-semibold text-gray-700">Poin Digunakan</p>
                <p class="text-gray-900">{{ number_format($pointUsed, 0, ',', '.') }} </p>
            </div>
            <div class="flex justify-between items-center mt-2">
                <p class="font-semibold text-gray-700">Kasir</p>
                <p class="text-gray-900">{{ $order->user->name }}</p>
            </div>
            <div class="flex justify-between items-center mt-2">
                <p class="font-semibold text-gray-700">Uang Pembeli</p>
                <p class="text-gray-900">Rp. {{ number_format($order->customer_pay, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between items-center mt-2">
                <p class="font-semibold text-gray-700">Kembalian</p>
                <p class="text-gray-900">Rp. {{ number_format($order->customer_return, 0, ',', '.') }}</p>
            </div>
        </div>

        @if ($order->members_id != null)
            <div class="bg-gray-900 text-white text-xl font-semibold p-4 mt-4 rounded-lg text-right shadow-md">
                <p>
                    <span class="text-red-500 line-through">
                        Rp. {{ number_format($originalTotalPrice, 0, ',', '.') }}
                    </span>
                    <span class="ml-2">➡</span>
                    <span>Rp. {{ number_format($order->total_harga_after_point, 0, ',', '.') }}</span>
                </p>
            </div>
        @else
            <div class="bg-gray-900 text-white text-xl font-semibold p-4 mt-4 rounded-lg text-right shadow-md">
                <p>TOTAL: Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</p>
            </div>
        @endif


        <div class="mt-6 flex justify-end gap-4">
            <a href="{{ route('orders.download-detail-order', $order->id) }}">
                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition duration-200">Unduh</button>
            </a>
            <a href="{{ route('orders.index') }}">
                <button
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg shadow-md transition duration-200">Kembali</button>
            </a>
        </div>
    </div>
@endsection
