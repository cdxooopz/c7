<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderCreated;
use App\Models\Product;

class UpdateStock
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        foreach ($event->order->orderDetail as $item) {
            $productEntitiy = Product::find($item->product_id);
            $productEntitiy->amount = $productEntitiy->amount - $item->amount;
            $productEntitiy->save();
            
        }
    }
}
