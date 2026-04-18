<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Create a regular test user
        User::factory()->create([
            'name' => 'Usuário Teste',
            'email' => 'user@ingressou.com',
            'is_admin' => false,
        ]);
    }
}
