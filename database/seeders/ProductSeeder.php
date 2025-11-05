<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::firstOrCreate(['name' => 'Electronics']);
        $fashion     = Category::firstOrCreate(['name' => 'Fashion']);

        Product::firstOrCreate([
            'name' => 'Wireless Headphones',
            'category_id' => $electronics->id,
        ],[
            'price' => 299.00,
            'stock_status' => 'in_stock',
        ]);

        Product::firstOrCreate([
            'name' => 'Cotton T-Shirt',
            'category_id' => $fashion->id,
        ],[
            'price' => 49.00,
            'stock_status' => 'out_of_stock',
        ]);
    }
}
