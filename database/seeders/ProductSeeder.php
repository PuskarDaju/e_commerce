<?php

namespace Database\Seeders;

use App\Models\Product;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats=([
            [
                'name' => 'Air Max-270',
                'description' => 'Stylish and comfortable running shoes.',
                'brand' => 'Nike',
                'category_id' => 1,
                'price' => 150.00,
                'size' => '8, 9, 10, 11',
                'color' => 'Black, White',
                'stock_quantity' => 50,
                'image_url' => 'air-max-270.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ultraboost 22',
                'description' => 'High-performance shoes for running.',
                'brand' => 'Adidas',
                'category_id' => 1,
                'price' => 180.00,
                'size' => '8, 9, 10, 11',
                'color' => 'Gray, Blue',
                'stock_quantity' => 30,
                'image_url' => 'ultraBost22.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Classic Slip-On',
                'description' => 'Lightweight and casual slip-on sneakers.',
                'brand' => 'Vans',
                'category_id' => 2,
                'price' => 60.00,
                'size' => '6, 7, 8, 9',
                'color' => 'Black, White',
                'stock_quantity' => 40,
                'image_url' => 'slip-on.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Chuck Taylor All Star',
                'description' => 'Iconic high-top sneakers.',
                'brand' => 'Converse',
                'category_id' => 2,
                'price' => 70.00,
                'size' => '7, 8, 9, 10',
                'color' => 'Red, White',
                'stock_quantity' => 25,
                'image_url' => 'Chuck Taylor All Star.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gel-Kayano 28',
                'description' => 'Stability-focused running shoes.',
                'brand' => 'ASICS',
                'category_id' => 1,
                'price' => 140.00,
                'size' => '8, 9, 10',
                'color' => 'Blue, Green',
                'stock_quantity' => 20,
                'image_url' => 'Gel-Kayano 28.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Old Skool',
                'description' => 'Classic skate shoes.',
                'brand' => 'Vans',
                'category_id' => 2,
                'price' => 75.00,
                'size' => '7, 8, 9',
                'color' => 'Black, Red',
                'stock_quantity' => 35,
                'image_url' => 'Old Skool.webp',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Superstar',
                'description' => 'Timeless basketball sneakers.',
                'brand' => 'Adidas',
                'category_id' => 2,
                'price' => 85.00,
                'size' => '7, 8, 9, 10',
                'color' => 'White, Black',
                'stock_quantity' => 40,
                'image_url' => 'Superstar.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pegasus 39',
                'description' => 'Reliable running shoes for daily training.',
                'brand' => 'Nike',
                'category_id' => 1,
                'price' => 130.00,
                'size' => '8, 9, 10, 11',
                'color' => 'Blue, Black',
                'stock_quantity' => 30,
                'image_url' => 'Pegasus 39.webp',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Stan Smith',
                'description' => 'Sleek, minimalist tennis-inspired sneakers.',
                'brand' => 'Adidas',
                'category_id' => 2,
                'price' => 90.00,
                'size' => '6, 7, 8, 9',
                'color' => 'White, Green',
                'stock_quantity' => 20,
                'image_url' => 'Stan Smith.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Huarache',
                'description' => 'Unique and stylish everyday sneakers.',
                'brand' => 'Nike',
                'category_id' => 2,
                'price' => 120.00,
                'size' => '7, 8, 9',
                'color' => 'Black, White',
                'stock_quantity' => 15,
                'image_url' => 'Huarache.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        foreach($cats as $cat){
            Product::create($cat);
        }
    }
}

