@extends('layouts.template')

@section('top_content')
@endsection

@section('modal')
    {{-- Modal Tambah Product --}}
    <div id="add-product-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm border border-gray-300">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Create New Product
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="add-product-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('products.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Product</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Type product name" required>
                        </div>
                        <div class="col-span-2">
                            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stok</label>
                            <input type="number" name="stock" id="stock"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Type stock" required>
                        </div>
                        <div class="col-span-2">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                            <input type="text" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Type Price" required>
                        </div>


                        <div class="col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload
                                Gambar</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="file_input" type="file" name="image" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new product
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Success alert!</span> {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Danger alert!</span>
            </div>
        </div>
    @endif

    <div class="relative overflow-x-auto sm:rounded-lg p-6 bg-white shadow-md">
        <h2 class="text-2xl font-bold text-[#3F4151] mb-4">Product Management</h2>

        <div class="flex flex-col sm:flex-row flex-wrap sm:items-center justify-between pb-4">
            <div class="relative flex items-center space-x-2">
                <input type="text" id="table-search"
                    class="block p-2 ps-10 text-sm hidden text-[#3F4151] border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-[#3F4151] focus:border-[#3F4151]"
                    placeholder="Search for products">
            </div>
            @if (Auth::user()->role == 'Admin')
                <a href="{{ route('products.export-products') }}"
                    class="flex items-center gap-2 text-white bg-green-600 hover:bg-green-700 focus:ring-green-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                    </svg>
                    Export Excel
                </a>
                <button type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal"
                    class="flex items-center gap-2 text-white bg-[#3F4151] hover:bg-gray-700 focus:ring-gray-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                    </svg>
                    Tambah Product
                </button>
            @endif

        </div>

        <table class="w-full text-sm text-left text-[#3F4151] border border-gray-200 rounded-lg overflow-hidden">
            <thead class="text-xs text-white uppercase bg-[#3F4151]">
                <tr>
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3"></th>
                    <th scope="col" class="px-6 py-3">Nama Product</th>
                    <th scope="col" class="px-6 py-3">Harga</th>
                    <th scope="col" class="px-6 py-3">Stok</th>
                    @if (Auth::user()->role == 'Admin')
                        <th scope="col" class="px-6 py-3">Action</th>
                    @else
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200 transition">
                        <th class="px-6 py-4 font-medium text-[#3F4151]">1</th>
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-32 h-32 object-cover rounded-md">
                        </td>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $product->stock }}</td>
                        @if (Auth::user()->role == 'Admin')
                            <td class="px-6 py-4">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="font-medium text-[#3F4151] hover:underline ml-2">Edit
                                </a> |
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus product ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="font-medium text-[#3F4151] hover:underline">Delete</button>
                                </form>

                            </td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 flex justify-between items-center">
            <p class="text-sm text-gray-600">
                Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} data
            </p>
            <div class="flex space-x-2">
                @if ($products->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                        ← Sebelumnya
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}"
                        class="px-3 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                        ← Sebelumnya
                    </a>
                @endif

                @foreach ($products->getUrlRange(max($products->currentPage() - 2, 1), min($products->currentPage() + 2, $products->lastPage())) as $page => $url)
                    @if ($page == $products->currentPage())
                        <span class="px-3 py-2 text-white bg-blue-500 rounded-md">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}"
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

    {{-- script Rupiah tambah data --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const priceInput = document.getElementById("price");

            priceInput.addEventListener("input", function(e) {
                let value = priceInput.value.replace(/\D/g, ""); // Hanya ambil angka
                value = new Intl.NumberFormat("id-ID").format(value); // Format angka dengan titik
                priceInput.value = value ? `Rp ${value}` : ""; // Tambahkan Rp di awal
            });

            priceInput.addEventListener("focus", function() {
                if (priceInput.value === "") {
                    priceInput.value = "Rp ";
                }
            });

            priceInput.addEventListener("blur", function() {
                if (priceInput.value === "Rp ") {
                    priceInput.value = "";
                }
            });
        });
    </script>
@endsection
