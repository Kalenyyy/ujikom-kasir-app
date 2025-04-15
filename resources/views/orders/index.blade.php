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


<!-- Extra Large Modal -->
<div id="extralarge-modal" tabindex="-1"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-7xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="text-xl font-medium text-gray-900">
                    Extra Large modal
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
                <form id="checkout-form" action="" method="POST">
                    <!-- Produk statis -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div class="w-full bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                            <img class="p-4 rounded-t-lg" src="https://via.placeholder.com/150" alt="product image" />
                            <h5 class="text-lg font-semibold text-gray-900">Teh Leci</h5>
                            <span class="text-sm text-gray-500">Stock: 25</span>
                            <div class="flex items-center justify-between mt-4">
                                <button type="button" onclick="decrement('1')"
                                    class="px-3 py-1 bg-gray-200 rounded-lg">-</button>
                                <span id="quantity-1" class="mx-3 text-lg font-semibold">0</span>
                                <button type="button" onclick="increment('1')"
                                    class="px-3 py-1 bg-blue-700 text-white rounded-lg">+</button>
                                <input type="hidden" name="product_ids[]" value="1">
                            </div>
                            <input type="hidden" id="input-quantity-1" name="quantities[1]" value="0">
                        </div>

                        <div class="w-full bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                            <img class="p-4 rounded-t-lg" src="https://via.placeholder.com/150" alt="product image" />
                            <h5 class="text-lg font-semibold text-gray-900">Teh Lemon</h5>
                            <span class="text-sm text-gray-500">Stock: 15</span>
                            <div class="flex items-center justify-between mt-4">
                                <button type="button" onclick="decrement('2')"
                                    class="px-3 py-1 bg-gray-200 rounded-lg">-</button>
                                <span id="quantity-2" class="mx-3 text-lg font-semibold">0</span>
                                <button type="button" onclick="increment('2')"
                                    class="px-3 py-1 bg-blue-700 text-white rounded-lg">+</button>
                                <input type="hidden" name="product_ids[]" value="2">
                            </div>
                            <input type="hidden" id="input-quantity-2" name="quantities[2]" value="0">
                        </div>
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




<div class="relative overflow-x-auto sm:rounded-lg p-6 bg-white shadow-md">
    <h2 class="text-2xl font-bold text-[#3F4151] mb-4">Penjualan Management</h2>

    <div class="flex flex-col sm:flex-row flex-wrap sm:items-center justify-between pb-4 space-y-2 sm:space-y-0">
        <div class="relative flex items-center space-x-2">
            <input type="text" id="table-search"
                class="block p-2 ps-10 text-sm text-[#3F4151] border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-[#3F4151] focus:border-[#3F4151]"
                placeholder="Search for users">
        </div>
        <div class="flex space-x-2">
            <a href=""
                class="flex items-center gap-2 text-white bg-green-600 hover:bg-green-700 focus:ring-green-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                </svg>
                Export Excel
            </a>

            <button type="button" data-modal-target="extralarge-modal" data-modal-toggle="extralarge-modal"
                class="flex items-center gap-2 text-white bg-[#3F4151] hover:bg-gray-700 focus:ring-gray-400 font-medium rounded-lg text-sm px-4 py-2 shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.5 1.5M4 9a8 8 0 0116 0v4a8 8 0 01-16 0V9z"></path>
                </svg>
                Tambah Penjualan
            </button>

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
            <tr class="bg-white border-b border-gray-200 hover:bg-gray-200 transition">
                <th class="px-6 py-4 font-medium text-[#3F4151]">#</th>
                <td class="px-6 py-4">Budi Santoso</td>
                <td class="px-6 py-4">2025-04-13</td>
                <td class="px-6 py-4">Rp 150.000</td>
                <td class="px-6 py-4">Admin 1</td>
                <td class="px-6 py-4 flex space-x-2">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Lihat Detail
                    </button>
                    <a href="#"
                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M12 16L6 10h4V4h4v6h4l-6 6zM4 20h16v2H4v-2z" />
                        </svg>
                        Unduh Bukti
                    </a>
                </td>
            </tr>
            <tr class="bg-white border-b border-gray-200 hover:bg-gray-200 transition">
                <th class="px-6 py-4 font-medium text-[#3F4151]">#</th>
                <td class="px-6 py-4">Siti Aminah</td>
                <td class="px-6 py-4">2025-04-12</td>
                <td class="px-6 py-4">Rp 200.000</td>
                <td class="px-6 py-4">Admin 2</td>
                <td class="px-6 py-4 flex space-x-2">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Lihat Detail
                    </button>
                    <a href="#"
                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M12 16L6 10h4V4h4v6h4l-6 6zM4 20h16v2H4v-2z" />
                        </svg>
                        Unduh Bukti
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="mt-4 flex justify-between items-center">
        <p class="text-sm text-gray-600">
            Menampilkan 1 - 2 dari 2 data
        </p>
        <div class="flex space-x-2">
            <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                ← Sebelumnya
            </span>
            <span class="px-3 py-2 text-white bg-blue-500 rounded-md">1</span>
            <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                Selanjutnya →
            </span>
        </div>
    </div>

</div>
