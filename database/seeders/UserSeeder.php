<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin', // sesuaikan
            'foto_profil' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Tambah user lain jika perlu
        User::create([
            'name' => 'Dwi',
            'email' => 'dwi@dom.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user123'),
            'role' => 'user', // sesuaikan
            'foto_profil' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}