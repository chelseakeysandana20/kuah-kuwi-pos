<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Owner Kuah Kuwi',
            'username' => 'owner',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        User::create([
            'name' => 'Kasir Utama',
            'username' => 'kasir',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
        ]);

        User::create([
            'name' => 'Staff Dapur',
            'username' => 'dapur',
            'password' => Hash::make('password123'),
            'role' => 'staff_dapur',
        ]);
    }
}