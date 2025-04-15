<form action="" method="post">
    <input type="hidden" name="member_id" value="12345">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg p-6 gap-6 flex justify-between">
            <!-- Bagian Kiri: Produk yang dipilih -->
            <div class="w-1/2">
                <h2 class="text-xl font-semibold mb-4">Produk yang dipilih</h2>

                <div class="space-y-3">
                    <!-- Produk 1 -->
                    <input type="hidden" name="products[1][id]" value="1">
                    <input type="hidden" name="products[1][quantity]" value="2">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-700 font-medium">Es Teh Leci</p>
                            <p class="text-gray-500 text-sm">Rp. 5.000 x 2</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-900">Rp. 10.000</p>
                    </div>

                    <!-- Produk 2 -->
                    <input type="hidden" name="products[2][id]" value="2">
                    <input type="hidden" name="products[2][quantity]" value="1">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-700 font-medium">Es Teh Lemon</p>
                            <p class="text-gray-500 text-sm">Rp. 6.000 x 1</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-900">Rp. 6.000</p>
                    </div>
                </div>

                <!-- Total -->
                <div class="mt-4 border-t pt-3">
                    <p class="text-lg font-semibold text-gray-900">Total</p>
                    <p class="text-2xl font-bold text-blue-600">Rp. 16.000</p>
                </div>
            </div>

            <!-- Bagian Kanan -->
            <div class="w-1/2 pl-6">
                <div class="mt-4">
                    <label for="name_member" class="text-gray-700 font-medium">Nama Member</label>
                    <input type="text" id="name_member" name="name_member" value="Angger Sutarto"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Nama Member">
                </div>

                <div id="phone-input" class="mt-4">
                    <label for="phone" class="text-gray-700 font-medium">Nomor Telepon</label>
                    <input type="text" id="phone" name="no_telp" value="081234567890" readonly
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed"
                        placeholder="Masukkan nomor telepon">
                </div>

                <div class="mt-4">
                    <label for="customer-pay" class="text-gray-700 font-medium">Jumlah Uang</label>
                    <input type="text" id="customer-pay" name="customer_pay"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed"
                        placeholder="Masukkan jumlah uang" readonly value="Rp. 20.000">
                </div>

                <div class="flex items-center mt-4 space-x-3">
                    <input id="helper-checkbox" type="checkbox" name="use_point"
                        class="w-5 h-5 text-blue-600 bg-gray-200 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 cursor-pointer">

                    <div class="text-sm">
                        <label for="helper-checkbox" class="font-medium text-gray-900">
                            Point: 1.000
                        </label>
                        <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500">
                            Kamu bisa menggunakan point untuk diskon.
                        </p>
                    </div>
                </div>

                <button id="order-button" type="submit"
                    class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">Pesan</button>
            </div>
        </div>
    </div>
</form>
