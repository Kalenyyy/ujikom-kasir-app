
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-3xl p-6">
        <div class="flex justify-between items-start border-b pb-4">
            <h2 class="text-xl font-semibold">Detail Penjualan</h2>
            <button onclick="" class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
        </div>

        <div class="mt-4 space-y-2">
            <div class="flex justify-between text-sm">
                <div>
                    <p><span class="font-semibold">Member Status:</span> Bukan Member</p>
                    <p><span class="font-semibold">No. HP:</span> -</p>
                    <p><span class="font-semibold">Poin Member:</span> 0</p>
                </div>
                <div>
                    <p><span class="font-semibold">Bergabung Sejak:</span> -</p>
                </div>
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
                        <tr class="border-b">
                            <td class="py-2">Minuman 1</td>
                            <td class="py-2 text-center">1</td>
                            <td class="py-2 text-right">Rp. 75.000</td>
                            <td class="py-2 text-right">Rp. 75.000</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-2">Makanan 2</td>
                            <td class="py-2 text-center">1</td>
                            <td class="py-2 text-right">Rp. 80.000</td>
                            <td class="py-2 text-right">Rp. 80.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 space-y-1 text-sm">
                <div class="flex justify-between font-semibold">
                    <span>Total Belanja</span>
                    <span>Rp. 155.000</span>
                </div>
                <div class="flex justify-between">
                    <span>Point Digunakan</span>
                    <span>0</span>
                </div>
                <div class="flex justify-between">
                    <span>Bayaran Pembeli</span>
                    <span>Rp. 200.000</span>
                </div>
                <div class="flex justify-between font-semibold">
                    <span>Kembalian</span>
                    <span>Rp. 45.000</span>
                </div>
            </div>

            <div class="text-sm text-gray-500 mt-4">
                <p>Dibuat pada: 12 April 2025</p>
                <p>Oleh: Kasir</p>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button onclick="" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md text-sm font-medium">Tutup</button>
        </div>
    </div>
</div>
@endsection
