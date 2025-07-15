<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProductController extends Controller
{
    // ✅ Toggle status sinkronisasi lokal
    public function sync($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->hub_product_id = $product->hub_product_id ? null : 'pending';
        $product->save();

        session()->flash('success', 'Status sinkronisasi produk diperbarui.');
        return redirect()->back();
    }

    // ✅ Sinkronkan ke Hub secara langsung
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

    // ✅ Toggle visibilitas produk
    public function toggleVisibility($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->is_visible = $request->input('is_on') ? true : false;
        $product->save();

        return response()->json(['message' => 'Status visibilitas diperbarui.']);
    }

    // ✅ Hapus dari Hub (hanya lokal)
    public function deleteProductFromHub($id)
    {
        $product = Product::findOrFail($id);
        $product->hub_product_id = null;
        $product->save();

        return response()->json(['message' => 'Produk dihapus dari Hub.']);
    }

    // ✅ Menampilkan semua produk
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    // ✅ Form create produk
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    // ✅ Simpan produk baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'nullable|string|max:100',
            'image_url' => 'nullable|url',
            'weight' => 'nullable|numeric',
            'is_active' => 'boolean',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Product::create($validatedData);

        session()->flash('success', 'Produk berhasil ditambahkan.');
        return redirect()->route('products.index');
    }

    // ✅ Form edit produk
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    // ✅ Update produk
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'nullable|string|max:100',
            'image_url' => 'nullable|url',
            'weight' => 'nullable|numeric',
            'is_active' => 'boolean',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        session()->flash('success', 'Produk berhasil diperbarui.');
        return redirect()->route('products.index');
    }

    // ✅ Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('success', 'Produk berhasil dihapus.');
        return redirect()->route('products.index');
    }

    public function deleteFromHub($id)
{
    $product = Product::findOrFail($id);

    // Kirim request DELETE ke API Hub
    $response = Http::delete(env('HUB_API_URL') . '/product/' . $product->hub_product_id, [
        'client_id' => env('CLIENT_ID'),
        'client_secret' => env('CLIENT_SECRET'),
    ]);

    if ($response->successful()) {
        // Hapus ID produk Hub dari database lokal
        $product->hub_product_id = null;
        $product->save();

        // Jika permintaan mengharapkan JSON (misal via fetch)
        if (request()->expectsJson()) {
            return response()->json(['message' => 'Produk berhasil dihapus dari Hub.']);
        }

        session()->flash('success', 'Produk berhasil dihapus dari Hub.');
    } else {
        if (request()->expectsJson()) {
            return response()->json(['message' => 'Gagal menghapus produk dari Hub.'], 500);
        }

        session()->flash('error', 'Gagal menghapus produk dari Hub.');
    }

    return redirect()->back();
}

}
