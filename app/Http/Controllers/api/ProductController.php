<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::with('category')->latest()->get());
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return new ProductResource($product);
    }

    public function syncProductToHub($id, Request $request)
    {
        $product = Product::with('category')->findOrFail($id);

        if ($product->category && !$product->category->is_active) {
            return response()->json(['message' => '❌ Kategori tidak aktif, gagal sync'], 400);
        }

        try {
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
                return response()->json(['message' => '✅ Produk berhasil disinkronkan ke Hub']);
            }

            Log::error('❌ Gagal Sync ke Hub', ['response' => $response->body()]);
            return response()->json(['message' => '❌ Gagal sinkron ke Hub'], 500);
        } catch (\Exception $e) {
            Log::error('❌ Error Sync ke Hub', ['error' => $e->getMessage()]);
            return response()->json(['message' => '❌ Terjadi kesalahan saat sync ke Hub'], 500);
        }
    }

    public function setVisible($id)
    {
        $product = Product::with('category')->findOrFail($id);

        if ($product->category && !$product->category->is_active) {
            return response()->json(['message' => '❌ Tidak bisa tampilkan, kategori tidak aktif.'], 400);
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

        return response()->json(['message' => '✅ Produk berhasil ditampilkan di Hub']);
    }



    public function setInvisible($id)
    {
        $product = Product::with('category')->findOrFail($id);

        if ($product->category && !$product->category->is_active) {
            return response()->json(['message' => '❌ Tidak bisa sembunyikan, kategori tidak aktif.'], 400);
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

        return response()->json(['message' => '✅ Produk berhasil disembunyikan di Hub']);
    }


    public function deleteFromLocal($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            Log::info('✅ Produk dihapus dari sistem lokal', ['product_id' => $id]);
            return response()->json(['message' => '✅ Produk berhasil dihapus dari sistem lokal']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => '❌ Produk tidak ditemukan'], 404);
        } catch (\Exception $e) {
            Log::error('❌ Error Hapus Produk Lokal', ['error' => $e->getMessage()]);
            return response()->json(['message' => '❌ Gagal hapus produk lokal'], 500);
        }
    }
}
