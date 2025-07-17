<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
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
        ]);

        $validated['id'] = Str::uuid();

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', '✅ Kategori berhasil ditambahkan.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
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
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', '✅ Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            // ✅ Hapus juga hub_product_id semua produk di kategori ini (optional)
            Product::where('category_id', $category->id)->update(['hub_product_id' => null]);

            return redirect()->route('categories.index')->with('success', '✅ Kategori & produk berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Kategori', ['error' => $e->getMessage()]);
            return redirect()->route('categories.index')->with('error', '❌ Terjadi kesalahan saat menghapus kategori.');
        }
    }

    public function syncToHub(Category $category)
    {
        try {
            $response = Http::post(env('HUB_API_URL') . '/product-category/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_category_id' => (string) $category->id,
                'name' => $category->name,
                'description' => $category->description ?? '-',
                'is_active' => true,
            ]);

            if ($response->successful() && isset($response['product_category_id'])) {
                $category->update([
                    'hub_category_id' => $response['product_category_id'],
                    'is_active' => true,
                ]);

                return back()->with('success', '✅ Kategori berhasil disinkronkan ke Hub.');
            }

            Log::error('❌ Gagal Sinkronisasi Kategori ke Hub', ['response' => $response->body()]);
            return back()->with('error', '❌ Gagal sinkronisasi kategori ke Hub.');
        } catch (\Exception $e) {
            Log::error('❌ Exception Sinkron Kategori ke Hub', ['error' => $e->getMessage()]);
            return back()->with('error', '❌ Terjadi kesalahan saat sinkronisasi ke Hub.');
        }
    }

    public function deactivateOnHub(Category $category)
    {
        if (!$category->hub_category_id) {
            return back()->with('error', '❌ Kategori belum pernah disinkronkan ke Hub.');
        }

        try {
            $response = Http::post(env('HUB_API_URL') . '/product-category/sync', [
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'seller_product_category_id' => (string) $category->id,
                'name' => $category->name,
                'description' => $category->description ?? '-',
                'is_active' => false,
            ]);

            if ($response->successful()) {
                $category->update(['is_active' => false]);

                // ✅ Cascade: Nonaktifkan semua produk dari kategori ini
                Product::where('category_id', $category->id)->update(['is_visible' => false]);

                return back()->with('success', '✅ Kategori & produk terkait berhasil dinonaktifkan di Hub.');
            }

            Log::error('❌ Gagal Nonaktifkan Kategori di Hub', ['status' => $response->status(), 'response' => $response->body()]);
            return back()->with('error', '❌ Gagal menonaktifkan kategori di Hub.');
        } catch (\Exception $e) {
            Log::error('❌ Exception Nonaktifkan Kategori di Hub', ['error' => $e->getMessage()]);
            return back()->with('error', '❌ Terjadi kesalahan saat menonaktifkan kategori di Hub.');
        }
    }
}
