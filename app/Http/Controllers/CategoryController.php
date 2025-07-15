<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function sync($id, Request $request)
    {
        $category = Category::findOrFail($id);

        Log::info('🟡 Syncing category to Hub...', [
            'id' => $category->id,
            'name' => $category->name,
            'desc' => $category->description,
            'active' => $request->is_active,
        ]);

        $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'seller_product_category_id' => (string) $category->id,
            'name' => $category->name,
            'description' => $category->description ?? '-',
            'is_active' => $request->is_active == 1 ? true : false,
        ]);

        Log::info('🔵 Sync category response', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        if ($response->successful() && isset($response['product_category_id'])) {
            $category->hub_category_id = $response['product_category_id'];
            $category->save();
        }

        session()->flash('successMessage', 'Category Synced Successfully');
        return redirect()->back();
    }




    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('categories.index', compact('categories'));
    }

    public function syncToHub($id, Request $request)
    {
        $category = Category::findOrFail($id);

        $response = Http::post(env('HUB_API_URL') . '/product-category/sync', [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'seller_product_category_id' => (string) $category->id,
            'name' => $category->name,
            'description' => $category->description ?? '',
            'is_active' => true,
        ]);

        if ($response->successful() && isset($response['product_category_id'])) {
            $category->hub_category_id = $response['product_category_id'];
            $category->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Kategori berhasil disinkronkan.',
                'hub_category_id' => $category->hub_category_id
            ]);
        }

        session()->flash('success', 'Kategori berhasil disinkronkan.');
        return redirect()->back();
    }


    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // $validated['slug'] = Str::slug($validated['name']);
        $validated['id'] = Str::uuid();

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');

    }
    public function show(string $id)
    {
    }
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));

    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        // $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');

    }
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        try {
            $category->delete();

            return redirect()->route('categories.index')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            \Log::error('❌ Gagal menghapus kategori', ['error' => $e->getMessage()]);

            return redirect()->route('categories.index')
                ->with('error', 'Terjadi kesalahan saat menghapus kategori.');
        }
    }

    public function deleteFromHub($id)
    {
        $category = Category::findOrFail($id);

        if (!$category->hub_category_id) {
            session()->flash('error', 'Kategori belum pernah disinkronkan ke Hub.');
            return redirect()->back();
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->delete(env('HUB_API_URL') . '/product-category/' . $category->hub_category_id, [
                    'client_id' => env('CLIENT_ID'),
                    'client_secret' => env('CLIENT_SECRET'),
                ]);

        Log::info('🗑️ Delete category from Hub', [
            'hub_category_id' => $category->hub_category_id,
            'response_status' => $response->status(),
            'response_body' => $response->body(),
        ]);

        if ($response->successful()) {
            $category->hub_category_id = null;
            $category->save();

            session()->flash('success', 'Kategori berhasil dihapus dari Hub.');
        } else {
            session()->flash('error', 'Gagal menghapus kategori dari Hub.');
        }

        return redirect()->back();
    }

}
