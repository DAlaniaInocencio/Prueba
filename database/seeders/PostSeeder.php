<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vacía la tabla de posts de forma segura
        Post::query()->delete(); // Cambiado a delete()

        $posts = [
            [
                'title' => 'title 2',
                'description' => 'description 1',
                'user_id' => '2',
            ],
            [
                'title' => 'title 3',
                'description' => 'description 3',
                'user_id' => '3',
            ],
            [
                'title' => 'title 4',
                'description' => 'description 3',
                'user_id' => '3',
            ]  
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['title' => $post['title']], // Verifica si el título ya existe
                [
                    'description' => $post['description'],
                    'user_id' => $post['user_id'],
                ]
            );
        }
    }
}
