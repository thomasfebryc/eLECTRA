<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'customerId' => 'ADM-0001',
            'address' => 'Jl. Admin', // Tambahan untuk memenuhi field wajib di DB
        ]);
    }
}
