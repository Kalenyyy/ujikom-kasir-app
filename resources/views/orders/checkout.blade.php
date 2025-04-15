<form action="" method="post">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg p-6 gap-6 flex justify-between">
            <!-- Bagian Kiri: Produk yang dipilih -->
            <div class="w-1/2">
                <h2 class="text-xl font-semibold mb-4">Produk yang dipilih</h2>

                <div class="space-y-3">
                    <input type="hidden" name="products[1][id]" value="1">
                    <input type="hidden" name="products[1][quantity]" value="2">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-700 font-medium">Teh Leci</p>
                            <p class="text-gray-500 text-sm">Rp. 5.000 x 2</p>
                        </div>
                        <p class="text-lg font-semibold text-gray-900">Rp. 10.000</p>
                    </div>

                    <input type="hidden" name="products[2][id]" value="2">
                    <input type="hidden" name="products[2][quantity]" value="1">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-700 font-medium">Teh Lemon</p>
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

            <!-- Bagian Kanan: Member Status dan Form -->
            <div class="w-1/2 pl-6">
                <div>
                    <label class="text-gray-700 font-medium">Member Status
                        <span class="text-red-500 text-sm">Dapat juga membuat member</span>
                    </label>
                    <select id="member-status" name="member_status"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="bukan-member">Bukan Member</option>
                        <option value="member">Member</option>
                    </select>
                </div>

                <!-- Input Nomor Telepon -->
                <div id="phone-input" class="mt-4 hidden">
                    <label for="phone" class="text-gray-700 font-medium">Nomor Telepon</label>
                    <input type="text" id="phone" name="no_telp"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Masukkan nomor telepon">
                </div>

                <div class="mt-4">
                    <label for="total-bayar" class="text-gray-700 font-medium">Total Bayar</label>
                    <input type="text" id="total-bayar" name="total_bayar"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Total Bayar">
                </div>

                <button id="order-button" disabled
                    class="mt-4 w-full bg-gray-400 text-white py-2 rounded-lg cursor-not-allowed">Pesan</button>
            </div>
        </div>
    </div>
</form>
