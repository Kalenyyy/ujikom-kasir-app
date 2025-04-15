<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::paginate(8);
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|string',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg', // Validasi gambar
        ]);


        $cleanedPrice = str_replace(['Rp', '.', ' '], '', $request->price);

        $imagePath = $request->file('image')->store('image_product', 'public');

        // Tambahkan produk baru ke database
        Product::create([
            'name' => $request->name,
            'price' => $cleanedPrice, // Simpan harga yang sudah bersih
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|string',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg', // Validasi gambar
        ]);

        $product = Product::findOrFail($id);

        $cleanedPrice = str_replace(['Rp', '.', ' '], '', $request->price);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('image_product', 'public');
        } else {
            $imagePath = $product->image; // Gunakan gambar lama jika tidak ada yang diupload
        }

        // Update produk di database
        $product->update([
            'name' => $request->name,
            'price' => $cleanedPrice, // Simpan harga yang sudah bersih
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product berhasil diperbarui');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar dari storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus produk dari database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product berhasil dihapus');
    }

    public function exportProducts() {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
