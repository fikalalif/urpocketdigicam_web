<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'weight' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['is_active'] = true;

        if ($request->hasFile('image')) {
            // Menggunakan disk default (cloudinary)
            $validated['image'] = $request->file('image')->store('products');
        }

        $product = Product::create($validated);
        $this->syncToHub($product);

        return redirect()->route('products.index')->with('success', '✅ Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'weight' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete($product->image);
            }
            // Simpan gambar baru
            $validated['image'] = $request->file('image')->store('products');
        }

        $product->update($validated);
        $this->syncToHub($product);

        return redirect()->route('products.index')->with('success', '✅ Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        try {
            // Hapus gambar dari Cloudinary jika ada
            if ($product->image) {
                Storage::delete($product->image);
            }

            $this->deleteFromHub($product);
            $product->delete();
            return redirect()->route('products.index')->with('success', '✅ Produk berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Produk', ['error' => $e->getMessage()]);
            return redirect()->route('products.index')->with('error', '❌ Terjadi kesalahan saat menghapus produk.');
        }
    }

    private function syncToHub(Product $product)
    {
        try {
            // Dapatkan URL absolut dari Cloudinary
            $imageUrl = $product->image ? Storage::url($product->image) : null;

            Http::post('https://api.phb-umkm.my.id/api/product/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
                'name' => $product->name,
                'description' => $product->description ?? '-',
                'price' => $product->price,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'image_url' => $imageUrl, // Kirim URL absolut
                'weight' => $product->weight,
                'is_active' => $product->is_active,
                'is_visible' => $product->is_visible,
                'category_id' => optional($product->category)->hub_category_id,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Gagal Sync Produk ke Hub', ['error' => $e->getMessage()]);
        }
    }

    // ... sisa method lainnya tidak perlu diubah ...
    public function setActive(Product $product)
    {
        $product->update(['is_active' => true]);
        $this->syncToHub($product);
        return back()->with('success', '✅ Produk berhasil diaktifkan di Hub.');
    }

    public function setInactive(Product $product)
    {
        $product->update(['is_active' => false]);
        $this->syncToHub($product);
        return back()->with('success', '✅ Produk berhasil dinonaktifkan di Hub.');
    }

    public function syncProductToHub(Product $product)
    {
        $this->syncToHub($product);
        return back()->with('success', '✅ Produk berhasil disinkronkan ke Hub.');
    }

    private function deleteFromHub(Product $product)
    {
        try {
            Http::post('https://api.phb-umkm.my.id/api/product/delete', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Produk di Hub', ['error' => $e->getMessage()]);
        }
    }
}
