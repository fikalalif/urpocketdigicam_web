<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\HubApiService;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;



class ProductController extends Controller
{



    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return new ProductResource($products, 200, "berhasil get data product");
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $products = Product::find($id);
        return new ProductResource($products, 200, "berhasil get data product");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
