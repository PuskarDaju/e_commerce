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
                'name'=>'Addidas X',
                'price'=> 26499,
                'description'=>'Best shoe for hiking extremly strong and flexible',
                'image'=>'adidasX.webp',
                'category'=>'hiking',
                'stock'=>10,
            ],
            [
                'name'=>'Nana',
                'price'=> 2699,
                'description'=>'Light Weight and flexible',
                'image'=>'nana.jpg',
                'category'=>'hiking',
                'stock'=>12
                ,

            ],[
                'name'=>'Nike Dunk',
                'price'=> 1499,
                'description'=>'Nothing',
                'image'=>'nikeDunk.png',
                'stock'=>3,
            ],[
                'name'=>'Nike Air',
                'price'=>4500,
                'description'=>'Best shoe for running',
                'image'=>'vectorX.jpg',
                'stock'=>45
            ]


        ]);
        foreach($products as $p){
            Product::create($p);
        }
    }
}
