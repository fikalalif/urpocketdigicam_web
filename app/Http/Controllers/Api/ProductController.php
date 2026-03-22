<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
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
        $product->update(['is_visible' => true]);
        return response()->json(['message' => '✅ Produk berhasil ditampilkan.']);
    }

    public function setInvisible($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['is_visible' => false]);
        return response()->json(['message' => '✅ Produk berhasil disembunyikan.']);
    }
}
