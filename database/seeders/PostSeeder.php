<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    private const MAX_NUM_TAGS = 4;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagsId = Tag::pluck('id')->toArray();
        $posts = Post::factory(50)->create()->each(function (Post $post) use ($tagsId) {
            $post->tags()->attach(self::devolverRandomIdTags($tagsId));
        });
        // foreach ($posts as $post) {
        //    $post->tags()->attach(self::devolverRandomIdTags($tagsId));
        // }

    }

    private static function devolverRandomIdTags(array $ids): array
    {
        shuffle($ids);

        return array_slice($ids, 0, random_int(1, self::MAX_NUM_TAGS));
    }
}
