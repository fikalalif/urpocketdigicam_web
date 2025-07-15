<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
    }
    public function store(Request $request)
    {
    }
    public function show(string $id)
    {
    }
    public function edit(string $id)
    {
    }
    public function update(Request $request, string $id)
    {
    }
    public function destroy(string $id)
    {
    }
}
