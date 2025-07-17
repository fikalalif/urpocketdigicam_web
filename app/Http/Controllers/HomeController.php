<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

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

    public function getBrandsByCategory(Request $request)
{
    $categoryId = $request->get('category_id');

    $categories = Category::select('categories.id', 'categories.name', DB::raw('COUNT(products.id) as total'))
        ->join('products', 'products.category_id', '=', 'categories.id')
        ->where('products.is_visible', true)
        ->when($categoryId, function ($query, $categoryId) {
            return $query->where('categories.id', $categoryId);
        })
        ->groupBy('categories.id', 'categories.name')
        ->orderByDesc('total')
        ->get();

    return response()->json($categories);
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