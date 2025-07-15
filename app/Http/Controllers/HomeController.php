<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_visible', true)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'price', 'image']);

        return view('home', compact('products'));
    }
}