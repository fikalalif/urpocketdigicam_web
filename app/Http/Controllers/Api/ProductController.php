<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private const HUB_URL = 'https://api.phb-umkm.my.id/api/product';

    public function index()
    {
        return ProductResource::collection(Product::latest()->get());
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function setVisible($id)
    {
        $product = Product::findOrFail($id);

        if ($product->category && !$product->category->is_active) {
            return response()->json(['message' => '❌ Tidak bisa ubah visibilitas, kategori tidak aktif.'], 400);
        }

        $product->update([
            'is_visible' => true,
            'is_active' => true,
            'stock' => $product->stock > 0 ? $product->stock : 1
        ]);

        $this->syncToHub($product, true);

        return response()->json(['message' => '✅ Produk berhasil ditampilkan & disinkronkan.']);
    }

    public function setInvisible($id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'is_visible' => false,
            'is_active' => false,
            'stock' => 0
        ]);

        $this->syncToHub($product, false);

        return response()->json(['message' => '✅ Produk berhasil disembunyikan & disinkronkan.']);
    }

    public function syncProductToHub($id)
    {
        $product = Product::findOrFail($id);
        $this->syncToHub($product, $product->is_active);

        return response()->json(['message' => '✅ Produk berhasil disinkronkan ke Hub']);
    }

    public function deleteFromLocal($id)
    {
        $product = Product::findOrFail($id);

        try {
            $this->deleteFromHub($product);
            $product->delete();

            return response()->json(['message' => '✅ Produk berhasil dihapus dari lokal & Hub']);
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Produk', ['error' => $e->getMessage()]);
            return response()->json(['message' => '❌ Terjadi kesalahan saat menghapus produk'], 500);
        }
    }

    private function syncToHub(Product $product, $status = true)
    {
        try {
            Http::post(self::HUB_URL . '/sync', [
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
            Log::error('❌ Gagal Sync Produk ke Hub', ['error' => $e->getMessage()]);
        }
    }

    private function deleteFromHub(Product $product)
    {
        try {
            Http::post(self::HUB_URL . '/delete', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Produk di Hub', ['error' => $e->getMessage()]);
        }
    }
}