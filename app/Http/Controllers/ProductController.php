<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    // Toggle status sinkronisasi lokal
    public function sync($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->hub_product_id = $product->hub_product_id ? null : 'pending';
        $product->save();

        session()->flash('success', 'Status sinkronisasi produk diperbarui.');
        return redirect()->back();
    }

    // Sinkronkan ke Hub secara langsung
    public function syncProductToHub($id, Request $request)
    {
        try {
            $product = Product::findOrFail($id);

            $response = Http::post('https://api.phb-umkm.my.id/api/product/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_id' => (string) $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'sku' => $product->sku,
                'image_url' => $product->image_url,
                'weight' => $product->weight,
                'is_active' => $request->input('is_active', true),
                'category_id' => (string) optional($product->category)->hub_category_id,
            ]);

            if ($response->successful() && isset($response['product_id'])) {
                $product->hub_product_id = $response['product_id'];
                $product->save();

                return response()->json([
                    'message' => 'Produk berhasil disinkronkan ke Hub.',
                    'hub_product_id' => $response['product_id']
                ]);
            }

            return response()->json(['message' => 'Gagal sinkronisasi ke Hub.'], 500);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function toggleVisibility($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->is_visible = $request->input('is_on') ? true : false;
        $product->save();

        return response()->json(['message' => 'Status visibilitas diperbarui.']);
    }

    public function deleteProductFromHub($id)
    {
        $product = Product::findOrFail($id);
        $product->hub_product_id = null;
        $product->save();

        return response()->json(['message' => 'Produk dihapus dari Hub.']);
    }

    public function index()
    {
        $products = \App\Models\Product::latest()->get(); // atau ->paginate(10)
        return view('products.index', compact('products'));
    }
}
