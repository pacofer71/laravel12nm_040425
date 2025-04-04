<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        $this->call(TagSeeder::class);

        Storage::deleteDirectory('img/posts');
        Storage::makeDirectory('img/posts');

        $this->call(PostSeeder::class);
    }
}
