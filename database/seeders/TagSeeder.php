<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagsConColores = [
            'programación' => '#3F51B5',  // Indigo 500 (Tema principal)
            'php' => '#673AB7',  // Deep Purple 500 (Lenguaje)
            'java' => '#E53935',  // Red 600 (Lenguaje)
            'javascript' => '#FFA000',  // Amber 700 (Lenguaje)
            'frontend' => '#0097A7',  // Cyan 700 (Área)
            'docker' => '#039BE5',  // Light Blue 600 (DevOps)
        ];
        foreach ($tagsConColores as $nombre => $color) {
            Tag::create(compact('nombre', 'color'));
        }
    }
}
