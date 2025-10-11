<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
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
        return CategoryResource::collection(Category::latest()->get());
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return new CategoryResource($category);
    }

    public function syncToHub($id)
    {
        $category = Category::findOrFail($id);

        try {
            $response = Http::post(self::HUB_URL . '/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_category_id' => (string) $category->id,
                'name' => $category->name,
                'description' => $category->description ?? '-',
                'is_active' => true,
            ]);

            if ($response->successful() && isset($response['product_category_id'])) {
                $category->update([
                    'hub_category_id' => $category->hub_category_id ?? $response['product_category_id'],
                    'is_active' => true,
                ]);

                // ✅ Update semua produk aktif + sync ke Hub
                $products = Product::where('category_id', $category->id)->get();

                foreach ($products as $product) {
                    $product->update(['is_active' => true]);
                    $this->syncProductToHub($product, true);
                }

                return response()->json(['message' => '✅ Kategori & produk berhasil disinkronkan & diaktifkan ke Hub']);
            }

            Log::error('❌ Gagal Sinkron Kategori ke Hub', ['response' => $response->body()]);
            return response()->json(['message' => '❌ Gagal sinkron kategori ke Hub'], 500);

        } catch (\Exception $e) {
            Log::error('❌ Exception Sinkron Kategori ke Hub', ['error' => $e->getMessage()]);
            return response()->json(['message' => '❌ Terjadi kesalahan saat sinkronisasi'], 500);
        }
    }

    public function deactivateOnHub($id)
    {
        $category = Category::findOrFail($id);

        if (!$category->hub_category_id) {
            return response()->json(['message' => '❌ Kategori belum pernah disinkronkan'], 400);
        }

        try {
            $response = Http::post(self::HUB_URL . '/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_category_id' => (string) $category->id,
                'name' => $category->name,
                'description' => $category->description ?? '-',
                'is_active' => false,
            ]);

            if ($response->successful()) {
                $category->update(['is_active' => false]);

                // ✅ Update semua produk is_active = false + sync ke Hub
                $products = Product::where('category_id', $category->id)->get();

                foreach ($products as $product) {
                    $product->update(['is_active' => false]);
                    $this->syncProductToHub($product, false);
                }

                return response()->json(['message' => '✅ Kategori & produk berhasil dinonaktifkan di Hub']);
            }

            Log::error('❌ Gagal Nonaktifkan Kategori di Hub', ['response' => $response->body()]);
            return response()->json(['message' => '❌ Gagal nonaktifkan kategori di Hub'], 500);

        } catch (\Exception $e) {
            Log::error('❌ Exception Nonaktifkan Kategori di Hub', ['error' => $e->getMessage()]);
            return response()->json(['message' => '❌ Terjadi kesalahan saat menonaktifkan'], 500);
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
            Log::error('❌ Gagal Sync Produk (dari API Kategori) ke Hub', ['error' => $e->getMessage()]);
        }
    }
}