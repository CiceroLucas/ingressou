<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the default admin user.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ingressou.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );
    }
}
