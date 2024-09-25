<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products=([
            [
                'name'=>'Scarpa Terra Brown Leather Light Men',
                'price'=> 26499,
                'description'=>'Best shoe for hiking extremly strong and flexible',
                'image'=>'Scarpa.webp',
                'category'=>'hiking',
                'stock'=>10,
            ],
            [
                'name'=>'Gold Star G10 G2008',
                'price'=> 2699,
                'description'=>'Light Weight and flexible',
                'image'=>'goldStar.webp',
                'category'=>'hiking',
                'stock'=>12
                ,

            ],[
                'name'=>'JD1 NK Black White Full Sneaker',
                'price'=> 1499,
                'description'=>'Nothing',
                'image'=>'jd1.webp',
                'stock'=>3,
            ]


        ]);
        foreach($products as $p){
            Product::create($p);
        }
    }
}
