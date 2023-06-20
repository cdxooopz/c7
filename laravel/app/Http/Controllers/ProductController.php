<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productList = Product::paginate(100);
        return response()->json($productList);
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
        $product = Product::create([
            'product_name' => $request->product_name,
            'product_type' => $request->product_type,
            'price' => $request->product_price,
            'amount' => $request->product_amount
        ]);
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Cache::has('product-'.$id)) 
        {
            $productEntity = Cache::get('product-'.$id);
        } 
        else 
        {
            $productEntity = Product::join('product_types','products.product_type', 'product_types.id')->find($id);
            Cache::put('product-'.$id, $productEntity);
        }
        return response()->json($productEntity);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->product_name ? $request->product_name : $product->product_name;
        $product->product_type = $request->product_type ? $request->product_type : $product->product_type;
        $product->price = $request->product_price ? $request->product_price : $product->price;
        $product->amount = $request->product_amount ? $request->product_amount : $product->amount;
        $product->save();
        Cache::put('product-'.$id, $product);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
