<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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
            'type' => 'required|in:sale,rental,both',
            'price' => 'required_if:type,sale,both|numeric|min:0',
            'rental_price' => 'required_if:type,rental,both|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'weight' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['is_available'] = $request->has('is_available');
        $validated['is_active'] = true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products');
        }

        Product::create($validated);

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
            'type' => 'required|in:sale,rental,both',
            'price' => 'required_if:type,sale,both|numeric|min:0',
            'rental_price' => 'required_if:type,rental,both|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'weight' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', '✅ Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $product->delete();
            return redirect()->route('products.index')->with('success', '✅ Produk berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Produk', ['error' => $e->getMessage()]);
            return redirect()->route('products.index')->with('error', '❌ Terjadi kesalahan saat menghapus produk.');
        }
    }

    public function setActive(Product $product)
    {
        $product->update(['is_active' => true]);
        return back()->with('success', '✅ Produk berhasil diaktifkan.');
    }

    public function setInactive(Product $product)
    {
        $product->update(['is_active' => false]);
        return back()->with('success', '✅ Produk berhasil dinonaktifkan.');
    }
}
