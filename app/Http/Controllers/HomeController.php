<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_visible', true)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home', compact('products'));
    }

    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->get('category_id');

        $products = Product::where('is_active', true)
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->with('category')
            ->paginate(12);

        return response()->json($products);
    }

    public function getMoreProducts(Request $request)
    {
        $offset = $request->get('offset', 0);

        $products = Product::where('is_visible', true)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->offset($offset)
            ->limit(6)
            ->get();

        return response()->json($products);
    }

    public function searchProducts(Request $request)
    {
        $query = $request->get('q');

        $products = Product::where('is_visible', true)
            ->where('name', 'LIKE', "%{$query}%")
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();

        return response()->json($products);
    }
}
