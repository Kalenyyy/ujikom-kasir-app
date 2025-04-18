@extends('layouts.template')

@section('top_content')
    <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fillRule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clipRule="evenodd"></path>
            </svg>
            <a href="" class="ml-1 text-sm font-medium text-white hover:text-white-500 md:ml-2">Data Penjualan</a>
        </div>
    </li>
@endsection

@section('modal')
    <div id="extralarge-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-7xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-medium text-gray-900">
                        Product WarungDoMie
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="extralarge-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form id="checkout-form" action="{{ route('orders.process') }}" method="POST">
                        @csrf
                        <!-- Produk statis -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($products as $product)
                                <div class="w-full bg-white border border-gray-200 rounded-lg shadow-sm p-2">
                                    <img class="p-2 rounded-t-lg w-24 h-24 object-cover mx-auto"
                                        src="{{ asset('storage/' . $product->image) }}" alt="product image" />

                                    <h5 class="text-md font-semibold text-gray-900 text-center mt-2">{{ $product->name }}
                                    </h5>

                                    <span class="text-sm text-gray-500 text-center block">Stock:
                                        {{ $product->stock }}</span>

                                    <div class="flex items-center justify-between mt-4">
                                        <button type="button" onclick="decrement('{{ $product->id }}')"
                                            class="px-2 py-1 bg-gray-200 rounded-lg">-</button>
                                        <span id="quantity-{{ $product->id }}" class="mx-2 text-md font-semibold">0</span>
                                        <button type="button" onclick="increment('{{ $product->id }}')"
                                            class="px-2 py-1 bg-blue-700 text-white rounded-lg">+</button>

                                        <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
                                    </div>

                                    <!-- Input hidden untuk menyimpan jumlah -->
                                    <input type="hidden" id="input-quantity-{{ $product->id }}"
                                        name="quantities[{{ $product->id }}]" value="0">
                                </div>
                            @endforeach
                        </div>

                        <!-- Modal footer -->
                        <div
                            class="flex items-center justify-center p-4 md:p-5 space-x-3 border-t border-gray-200 rounded-b mt-4">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                Checkout
                            </button>
                            <button type="button" data-modal-hide="extralarge-modal"
                                class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="relative overflow-x-auto sm:rounded-lg p-6 bg-white shadow-md">
        <h2 class="text-2xl font-bold text-[#3F4151] mb-4">Penjualan Management</h2>

        <div class="flex flex-col sm:flex-row flex-wrap sm:items-center justify-between pb-4 space-y-2 sm:space-y-0">
            <div class="relative flex items-center space-x-2">
                <input type="text" id="table-search"
                    class="block p-2 ps-10 hidden text-sm text-[#3F4151] border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-[#3F4151] focus:border-[#3F4151]"
                    placeholder="Search for users">
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('orders.export-orders') }}"
                    class="flex items-center gap-2 text-white bg-green-600 hover:bg-green-700 focus:ring-green-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                    </svg>
                    Export Excel
                </a>

                @if (Auth::user()->role == 'Petugas')
                    <button type="button" data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
                        class="flex items-center gap-2 text-white bg-[#3F4151] hover:bg-gray-700 focus:ring-gray-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                        </svg>
                        Tambah Penjualan
                    </button>
                @endif

            </div>
        </div>


        <table class="w-full text-sm text-left text-[#3F4151] border border-gray-200 rounded-lg overflow-hidden">
            <thead class="text-xs text-white uppercase bg-[#3F4151]">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Nama Pelanggan</th>
                    <th scope="col" class="px-6 py-3">Tanggal Penjualan</th>
                    <th scope="col" class="px-6 py-3">Total Harga</th>
                    <th scope="col" class="px-6 py-3">Dibuat Oleh</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200 transition">
                        <th class="px-6 py-4 font-medium text-[#3F4151]">
                            #
                        </th>
                        @if ($order->members_id)
                            <td class="px-6 py-4">{{ $order->member->name_member }}</td>
                        @else
                            <td class="px-6 py-4">{{ $order->name_customer }}</td>
                        @endif
                        <td class="px-6 py-4">{{ $order->tanggal_penjualan }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('orders.page-detail-order', $order->id) }}">
                                <button data-modal-target="sales-detail-modal" data-modal-toggle="sales-detail-modal"
                                    class="sales-detail text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    Lihat Detail
                                </button>
                            </a>

                            <a href="{{ route('orders.download-detail-order', $order->id) }}"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path d="M12 16L6 10h4V4h4v6h4l-6 6zM4 20h16v2H4v-2z" />
                                </svg>
                                Unduh Bukti
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 flex justify-between items-center">
            <p class="text-sm text-gray-600">
                Menampilkan {{ $orders->firstItem() }} - {{ $orders->lastItem() }} dari {{ $orders->total() }} data
            </p>
            <div class="flex space-x-2">
                @if ($orders->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                        ← Sebelumnya
                    </span>
                @else
                    <a href="{{ $orders->previousPageUrl() }}"
                        class="px-3 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                        ← Sebelumnya
                    </a>
                @endif

                @foreach ($orders->getUrlRange(max($orders->currentPage() - 2, 1), min($orders->currentPage() + 2, $orders->lastPage())) as $page => $url)
                    @if ($page == $orders->currentPage())
                        <span class="px-3 py-2 text-white bg-blue-500 rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if ($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}"
                        class="px-3 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                        Selanjutnya →
                    </a>
                @else
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                        Selanjutnya →
                    </span>
                @endif
            </div>
        </div>

    </div>

    <script>
        function increment(id) {
            let quantityElement = document.getElementById(`quantity-${id}`);
            let inputElement = document.getElementById(`input-quantity-${id}`);
            let quantity = parseInt(quantityElement.innerText);

            quantityElement.innerText = quantity + 1;
            inputElement.value = quantity + 1;
        }

        function decrement(id) {
            let quantityElement = document.getElementById(`quantity-${id}`);
            let inputElement = document.getElementById(`input-quantity-${id}`);
            let quantity = parseInt(quantityElement.innerText);

            if (quantity > 0) {
                quantityElement.innerText = quantity - 1;
                inputElement.value = quantity - 1;
            }
        }
    </script>
@endsection
