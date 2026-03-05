<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'customerId' => '0000000000',
            'address' => 'Kantor Pusat',
        ]);
    }
}
