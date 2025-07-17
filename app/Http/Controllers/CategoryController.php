<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    private const HUB_URL = 'https://api.phb-umkm.my.id/api/product-category';
    private const PRODUCT_HUB_URL = 'https://api.phb-umkm.my.id/api/product';

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'is_visible' => 'boolean',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', '✅ Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'is_visible' => 'boolean',
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', '✅ Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Product::where('category_id', $category->id)->update(['hub_product_id' => null]);

            return redirect()->route('categories.index')->with('success', '✅ Kategori & produk berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Kategori', ['error' => $e->getMessage()]);
            return redirect()->route('categories.index')->with('error', '❌ Terjadi kesalahan saat menghapus kategori.');
        }
    }

    public function syncToHub(Category $category)
    {
        return $this->syncCategoryStatus($category, true);
    }

    public function deactivateOnHub(Category $category)
    {
        return $this->syncCategoryStatus($category, false);
    }

    private function syncCategoryStatus(Category $category, bool $status)
    {
        if (!$status && !$category->hub_category_id) {
            return back()->with('error', '❌ Kategori belum pernah disinkronkan ke Hub.');
        }

        try {
            $response = Http::post(self::HUB_URL . '/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_category_id' => (string) $category->id,
                'name' => $category->name,
                'description' => $category->description ?? '-',
                'is_active' => $status,
            ]);

            if ($response->successful()) {
                $category->update([
                    'is_active' => $status,
                    'hub_category_id' => $category->hub_category_id ?? $response['product_category_id'] ?? null,
                ]);

                // ✅ Update & Sync semua produk di kategori ini
                $products = Product::where('category_id', $category->id)->get();

                foreach ($products as $product) {
                    $product->update(['is_active' => $status]);
                    $this->syncProductToHub($product, $status);
                }

                $msg = $status ? '✅ Kategori & semua produk berhasil diaktifkan di Hub.' : '✅ Kategori & semua produk berhasil dinonaktifkan di Hub.';
                return back()->with('success', $msg);
            }

            Log::error('❌ Gagal Sinkronisasi Kategori ke Hub', ['response' => $response->body()]);
            return back()->with('error', '❌ Gagal sinkronisasi kategori ke Hub.');

        } catch (\Exception $e) {
            Log::error('❌ Exception Sinkron Kategori ke Hub', ['error' => $e->getMessage()]);
            return back()->with('error', '❌ Terjadi kesalahan saat sinkronisasi.');
        }
    }

    private function syncProductToHub(Product $product, bool $status)
    {
        try {
            Http::post(self::PRODUCT_HUB_URL . '/sync', [
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
                'is_active' => $status,
                'is_visible' => $product->stock > 0 ? $product->is_visible : false,
                'category_id' => optional($product->category)->hub_category_id,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Gagal Sync Produk dari CategoryController ke Hub', ['error' => $e->getMessage()]);
        }
    }
}