<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;




class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $cats=([
            [
                'name' => 'Running Shoes',
                'description' => 'Shoes designed for running and athletic activities.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Casual Sneakers',
                'description' => 'Comfortable sneakers for everyday wear.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Formal Shoes',
                'description' => 'Elegant shoes for formal occasions and business wear.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sandals',
                'description' => 'Open-toe footwear perfect for summer and casual outings.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Boots',
                'description' => 'Durable and stylish boots for outdoor and rugged use.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sports Shoes',
                'description' => 'Specialized shoes for sports and training activities.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kids Shoes',
                'description' => 'Comfortable and stylish shoes for children.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Slippers',
                'description' => 'Light and casual footwear for indoor or outdoor use.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Loafers',
                'description' => 'Slip-on shoes suitable for both casual and formal wear.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Heels',
                'description' => 'Fashionable shoes with elevated heels for women.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        foreach($cats as $cat){
            category::create($cat); 
        }
    
    }
}
