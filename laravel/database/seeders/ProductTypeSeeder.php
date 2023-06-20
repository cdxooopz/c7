<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Accessories', 'Tablet', 'Computer', 'Networks', 'Mobile'];

        foreach($names as $k) {
            $productType = new ProductType([
                'type' => $k,
            ]);
            $productType->save();
        }
    }
}
