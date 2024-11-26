<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = ['Credit Card', 'Cash', 'Bank Transfer', 'PayPal'];

        // Generate 20 transactions
        $sales = [];
        for ($i = 1; $i <= 20; $i++) {
            $sales[] = [
                'user_id' => rand(1, 4), // Random user_id between 1 and 4
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'total_amount' => rand(50000, 200000) / 100, // Random amount between 500.00 and 2000.00
                'created_at' => Carbon::now()->subDays(rand(1, 365)), // Random date within the last year
                'updated_at' => Carbon::now(),
            ];
        }

        // Insert into the database
    DB::table('sales')->insert($sales);
    }
}
