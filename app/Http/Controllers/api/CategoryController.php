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
            $response = Http::post(env('HUB_API_URL') . '/api/product-category/sync', [
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

                return response()->json(['message' => '✅ Kategori berhasil disinkronkan ke Hub']);
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
            $response = Http::post(env('HUB_API_URL') . '/api/product-category/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_category_id' => (string) $category->id,
                'name' => $category->name,
                'description' => $category->description ?? '-',
                'is_active' => false,
            ]);

            if ($response->successful()) {
                $category->update(['is_active' => false]);

                // Cascade: Nonaktifkan semua produk yang terkait
                Product::where('category_id', $category->id)->update(['is_visible' => false]);

                return response()->json(['message' => '✅ Kategori & semua produk di dalamnya berhasil dinonaktifkan']);
            }

            Log::error('❌ Gagal Nonaktifkan Kategori di Hub', ['response' => $response->body()]);
            return response()->json(['message' => '❌ Gagal nonaktifkan kategori di Hub'], 500);
        } catch (\Exception $e) {
            Log::error('❌ Exception Nonaktifkan Kategori di Hub', ['error' => $e->getMessage()]);
            return response()->json(['message' => '❌ Terjadi kesalahan saat menonaktifkan'], 500);
        }
    }

    public function activateOnHub($id)
    {
        $category = Category::findOrFail($id);

        if (!$category->hub_category_id) {
            return response()->json(['message' => '❌ Kategori belum pernah disinkronkan'], 400);
        }

        try {
            $response = Http::post(env('HUB_API_URL') . '/api/product-category/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_category_id' => (string) $category->id,
                'name' => $category->name,
                'description' => $category->description ?? '-',
                'is_active' => true,
            ]);

            if ($response->successful()) {
                $category->update(['is_active' => true]);

                return response()->json(['message' => '✅ Kategori berhasil diaktifkan kembali di Hub']);
            }

            Log::error('❌ Gagal Aktifkan Kategori di Hub', ['response' => $response->body()]);
            return response()->json(['message' => '❌ Gagal aktifkan kategori di Hub'], 500);
        } catch (\Exception $e) {
            Log::error('❌ Exception Aktifkan Kategori di Hub', ['error' => $e->getMessage()]);
            return response()->json(['message' => '❌ Terjadi kesalahan saat mengaktifkan'], 500);
        }
    }
}
