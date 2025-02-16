<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Internet 10 Mbps',
            'Internet 20 Mbps',
            'Internet 50 Mbps',
            'Internet 100 Mbps'
        ];

        foreach ($products as $productName) {
            Product::create([
                'name' => $productName,
                'description' => 'Layanan internet dengan kecepatan ' . $productName,
                'price' => rand(200000, 1000000)
            ]);
        }
    }
}
