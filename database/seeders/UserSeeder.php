<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin user
        User::create([
            'name' => 'Admin Andi',
            'email' => 'andi@admin.com',
            'password' => Hash::make('andi1234'),
            'role' => 'admin',
        ]);

        // Petugas user
        User::create([
            'name' => 'Pak Ari',
            'email' => 'ari@guru.com',
            'password' => Hash::make('ari1234'), 
            'role' => 'guru',
        ]);
    }
}