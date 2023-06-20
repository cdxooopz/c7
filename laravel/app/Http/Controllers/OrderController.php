<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Events\OrderCreated;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $orderDetail = [];

        $order = \App\Models\Order::create([
            'email' => $request->email,
            'phone' => str_replace("-","",$request->phone),
            'address_shipping' => $request->address_shipping,
            'address_invoice' => $request->address_invoice,
            'total' => 0
        ]);
        if($request->product) 
        {
            foreach($request->product as $k => $product) 
            {
                $productEntitiy = \App\Models\Product::find($product);
                \App\Models\OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product,
                    'amount' => $request->amount[$k],
                    'price' => $productEntitiy->amount,
                    'total_price' => $productEntitiy->amount*$request->amount[$k]
                ]);
                // $productEntitiy->save();
            }
        }
        $orderUpdateTotal = \App\Models\Order::find($order->id);
        $orderUpdateTotal->total = $orderUpdateTotal->orderDetail->sum('total_price');
        $orderUpdateTotal->save();
        event(new OrderCreated($order));
        return response()->json($orderUpdateTotal);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
