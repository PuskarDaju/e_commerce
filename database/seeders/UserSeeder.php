<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members=([
            [
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'password' =>'password',
                'userType' => 'admin'
            ],
            [
                'name' => 'Puskar Niroula',
                'email' => 'puskar@gmail.com',
                'password' =>'password',
                'userType' => 'admin'
            ],
            [
                'name' => 'Sanjog Niroula',
                'email' => 'sanjog@gmail.com',
                'password' =>'password',
               
            ],
            [
                'name' => 'Nischal Basnet',
                'email' => 'nischal@gmail.com',
                'password' =>'password',
                
            ],
            [
                'name' => 'Kshitiz Timsina',
                'email' => 'kshitiz@gmail.com',
                'password' =>'password',
                
            ]
        ]);

        foreach($members as $member){
            User::create($member);
        }
    }
}
