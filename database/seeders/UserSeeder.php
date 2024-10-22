<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vacía la tabla de usuarios de forma segura
        User::query()->delete(); // Cambiado a delete()


        $users = [
            [
                'name' => 'darvin',
                'email' => 'darvin@example.com',
                'password' => "password",
                'role' => 'admin',
            ],
            [
                'name' => 'ricardo',
                'email' => 'ricardo@example.com',
                'password' => '1234',
                'role' => 'user',
            ],
            [
                'name' => 'pedrito',
                'email' => 'pedrito@example.com',
                'password' => "password123",
                'role' => 'user',
            ],
            [
                'name' => 'eduardo',
                'email' => 'eduardo@example.com',
                'password' =>"guestpass",
                'role' => 'guest',
            ],
            [
                'name' => 'Miguel',
                'email' => 'miguel@example.com',
                'password' => "miguelpass",
                'role' => 'guest',
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // Verifica si el email ya existe
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']), // Encripta la contraseña aquí
                    'role' => $user['role'],
                ]
            );
        }
    }
}
