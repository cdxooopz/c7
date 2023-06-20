<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productTypeList = ProductType::paginate(100);
        return response()->json($productTypeList);
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
        $productType = ProductType::create([
            'type' => $request->category
        ]);
        return response()->json($productType);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Cache::has('productType-'.$id)) 
        {
            $productTypeEntity = Cache::get('productType-'.$id);
        } 
        else 
        {
            $productTypeEntity = ProductType::find($id);
            Cache::put('productType-'.$id, $productTypeEntity);
        }
        return response()->json($productTypeEntity);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $productType = ProductType::find($id);
        $productType->type = $request->category ? $request->category : $productType->type;
        $productType->save();
        Cache::put('productType-'.$id, $productType);
        return response()->json($productType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductType $productType)
    {
        //
    }
}
