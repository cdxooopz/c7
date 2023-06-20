<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Faker\Generator as Faker;
use App\Models\OrderDetail;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productID = $this->faker->numberBetween(1,100000);
        $productEntity = \App\Models\Product::find($productID);
        $productAmount = $this->faker->numberBetween(1,10);
        return [
            'order_id' => $this->faker->numberBetween(1,50000),
            'product_id' => $productID,
            'amount' => $productAmount,
            'price' => $productEntity->price,
            'total_price' => $productEntity->price * $productAmount
        ];
    }

}
