<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));

        return [
            'titulo' => fake()->unique()->realText(random_int(20, 40)),
            'contenido' => fake()->realText(250),
            'imagen' => 'img/posts/'.fake()->picsum('public/storage/img/posts', 640, 480, false),
            'estado' => random_int(1, 2),
            'user_id' => User::all()->random()->id,
        ];
    }
}
