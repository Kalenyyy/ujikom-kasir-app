
    <div class="px-6 py-10 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Update Product</h2>

        <form class="space-y-6 bg-white p-6 rounded-xl shadow-sm border">
            <!-- Name -->
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none"
                    placeholder="Enter product name">
            </div>

            <!-- Price & Stock -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Price</label>
                    <input type="text" id="price"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none"
                        placeholder="e.g. 10000">
                </div>
                <div>
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="stock"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none"
                        placeholder="e.g. 10">
                </div>
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block mb-2 text-sm font-medium text-gray-700">Category</label>
                <select id="category"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="">Select Category</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Upload Gambar</label>
                <input type="file" id="image"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0 file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <!-- Image Preview -->
            <div>
                <img src="https://via.placeholder.com/150" alt="Product Preview"
                    class="w-32 h-32 object-cover rounded-md border">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm transition">
                    + Update data product
                </button>
            </div>
        </form>
    </div>