<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            //colum table db => value
            'id' => "1",
            'email' => "admin@gmail.com",
            'name' => "Admin",
            'role' => 'Admin',
            "password" => Hash::make("1234"),


        ]);
        User::create([
            //colum table db => value
            'id' => "2",
            'email' => "petugas@gmail.com",
            'name' => "Angger Kalehandya",
            'role' => 'Petugas',
            "password" => Hash::make("1234"),


        ]);
    }
}
