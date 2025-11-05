<?php

namespace Database\Seeders;

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
        // Define 5 categories
        $categories = [
            'Electronics',
            'Fashion',
            'Home & Kitchen',
            'Beauty & Health',
            'Sports & Outdoors',
        ];

        // Create categories and keep references
        $categoryModels = [];
        foreach ($categories as $name) {
            $categoryModels[$name] = Category::firstOrCreate(['name' => $name]);
        }

        // Define sample products (3 per category)
        $products = [
            // Electronics
            ['Wireless Headphones', 299.00, 'in_stock', 'Electronics'],
            ['Smartphone Pro X', 899.00, 'in_stock', 'Electronics'],
            ['Bluetooth Speaker', 149.00, 'out_of_stock', 'Electronics'],

            // Fashion
            ['Cotton T-Shirt', 49.00, 'out_of_stock', 'Fashion'],
            ['Slim Fit Jeans', 89.00, 'in_stock', 'Fashion'],
            ['Leather Jacket', 299.00, 'in_stock', 'Fashion'],

            // Home & Kitchen
            ['Air Fryer 5L', 199.00, 'in_stock', 'Home & Kitchen'],
            ['Coffee Maker Deluxe', 129.00, 'in_stock', 'Home & Kitchen'],
            ['Electric Kettle', 59.00, 'out_of_stock', 'Home & Kitchen'],

            // Beauty & Health
            ['Vitamin C Serum', 79.00, 'in_stock', 'Beauty & Health'],
            ['Herbal Shampoo', 39.00, 'in_stock', 'Beauty & Health'],
            ['Hair Dryer Pro', 159.00, 'out_of_stock', 'Beauty & Health'],

            // Sports & Outdoors
            ['Yoga Mat Pro', 69.00, 'in_stock', 'Sports & Outdoors'],
            ['Mountain Bike Helmet', 199.00, 'in_stock', 'Sports & Outdoors'],
            ['Tennis Racket Set', 249.00, 'out_of_stock', 'Sports & Outdoors'],
        ];

        // Create products
        foreach ($products as [$name, $price, $stockStatus, $categoryName]) {
            $category = $categoryModels[$categoryName] ?? null;
            if (! $category) continue;

            Product::firstOrCreate(
                ['name' => $name, 'category_id' => $category->id],
                [
                    'price' => $price,
                    'stock_status' => $stockStatus,
                ]
            );
        }

        $this->command->info('Product seeding completed!');
    }
}
