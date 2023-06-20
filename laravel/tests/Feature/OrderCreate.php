<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class OrderCreate extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function test_create_order(): void
    {
        $order = \App\Models\Order::create([
            'email' => 'test@mail.com',
            'phone' => str_replace("-","",'099-0909990'),
            'address_shipping' => 'Bangkok, 10900',
            'address_invoice' => 'Khonkaen, 40000',
            'total' => 900
        ]);

        \App\Models\OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => '1234',
            'amount' => '1',
            'price' => 900,
            'total_price' => 900
        ]);

        $order->total = $order->orderDetail->sum('total_price');
        $order->save();
    }
}
