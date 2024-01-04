<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             // Create a sample admin
             Admin::create([
                'first_name' => 'admin',
                'last_name' => 'ai4d',
                'username' => 'adminai4d@',
                'password' => Hash::make('adminai4d@2023'),
                'email' => 'adminai4d@gmail.com',
            ]);
    }
}
