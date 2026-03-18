<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Usamos updateOrCreate para evitar erro caso você rode o comando duas vezes
        User::updateOrCreate(
            ['email' => 'admin@floricultura.com'], // O e-mail de login
            [
                'name' => 'Administrador Chefe',
                'password' => Hash::make('senha123'), // A senha que você vai usar
                'is_admin' => 1, // Aqui está a mágica! Já nasce com permissão
            ]
        );
    }
}