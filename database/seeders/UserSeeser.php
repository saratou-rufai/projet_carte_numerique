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
            'nom' => 'Admin',
            'prenom' => 'Principal',
            'email' => 'admin@bf.com',
            'password' => Hash::make('1234'), // mot de passe
            'role' => 'admin',
        ]);
    }
}