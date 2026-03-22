<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        ]);

        $validated['is_visible'] = $request->has('is_visible');

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', '✅ Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', '✅ Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('❌ Gagal Hapus Kategori', ['error' => $e->getMessage()]);
            return redirect()->route('categories.index')->with('error', '❌ Terjadi kesalahan saat menghapus kategori.');
        }
    }
}
