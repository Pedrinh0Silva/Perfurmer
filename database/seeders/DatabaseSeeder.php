<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Chama o seeder do administrador
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}