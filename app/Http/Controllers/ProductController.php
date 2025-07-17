<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'weight' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_visible'] = true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
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
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'weight' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', '✅ Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        try {
            $product->update(['hub_product_id' => null]);
            $product->delete();
            return redirect()->route('products.index')->with('success', '✅ Produk berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Produk', ['error' => $e->getMessage()]);
            return redirect()->route('products.index')->with('error', '❌ Terjadi kesalahan saat menghapus produk.');
        }
    }
    public function setVisible(Product $product)
    {
        if ($product->category && !$product->category->is_active) {
            return back()->with('error', '❌ Tidak bisa tampilkan, kategori tidak aktif.');
        }

        $product->update(['is_visible' => true]);

        try {
            Http::post(env('HUB_API_URL') . '/product/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
                'name' => $product->name,
                'description' => $product->description ?? '-',
                'price' => $product->price,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'image_url' => $product->image,
                'weight' => $product->weight,
                'is_active' => $product->is_active,
                'is_visible' => true,
                'category_id' => optional($product->category)->hub_category_id,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Gagal Set Visible Produk di Hub', ['error' => $e->getMessage()]);
        }

        return back()->with('success', '✅ Produk berhasil ditampilkan di Hub.');
    }

    public function setInvisible(Product $product)
    {
        if ($product->category && !$product->category->is_active) {
            return back()->with('error', '❌ Tidak bisa sembunyikan, kategori tidak aktif.');
        }

        $product->update(['is_visible' => false]);

        try {
            Http::post(env('HUB_API_URL') . '/product/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
                'name' => $product->name,
                'description' => $product->description ?? '-',
                'price' => $product->price,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'image_url' => $product->image,
                'weight' => $product->weight,
                'is_active' => $product->is_active,
                'is_visible' => false,
                'category_id' => optional($product->category)->hub_category_id,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Gagal Set Invisible Produk di Hub', ['error' => $e->getMessage()]);
        }

        return back()->with('success', '✅ Produk berhasil disembunyikan di Hub.');
    }


    public function syncProductToHub(Product $product)
    {
        try {
            if ($product->category && !$product->category->is_active) {
                return back()->with('error', '❌ Kategori produk tidak aktif. Tidak bisa sync ke Hub.');
            }

            $response = Http::post(env('HUB_API_URL') . '/product/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
                'name' => $product->name,
                'description' => $product->description ?? '-',
                'price' => $product->price,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'image_url' => $product->image,
                'weight' => $product->weight,
                'is_active' => $product->is_active,
                'is_visible' => $product->is_visible,
                'category_id' => optional($product->category)->hub_category_id,
            ]);

            if ($response->successful() && isset($response['product_id'])) {
                $product->update(['hub_product_id' => $response['product_id']]);
                return back()->with('success', '✅ Produk berhasil disinkronkan ke Hub.');
            }

            Log::error('❌ Gagal Sync Produk ke Hub', ['response' => $response->body()]);
            return back()->with('error', '❌ Gagal sinkronisasi produk ke Hub.');
        } catch (\Exception $e) {
            Log::error('❌ Exception Sync Produk ke Hub', ['error' => $e->getMessage()]);
            return back()->with('error', '❌ Terjadi kesalahan saat sinkronisasi produk ke Hub.');
        }
    }

    public function deactivateOnHub(Product $product)
    {
        if ($product->category && !$product->category->is_active) {
            return response()->json(['message' => '❌ Tidak bisa nonaktifkan, kategori tidak aktif.'], 400);
        }

        $product->update([
            'is_active' => false,
            'is_visible' => false
        ]);

        try {
            Http::post(env('HUB_API_URL') . '/product/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
                'name' => $product->name,
                'description' => $product->description ?? '-',
                'price' => $product->price,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'image_url' => $product->image,
                'weight' => $product->weight,
                'is_active' => false,
                'is_visible' => false, // <- ini penting buat nyocokin di Hub
                'category_id' => optional($product->category)->hub_category_id,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Gagal Nonaktifkan Produk di Hub', ['error' => $e->getMessage()]);
        }

        return response()->json(['message' => '✅ Produk berhasil dinonaktifkan di Hub']);
    }
}
