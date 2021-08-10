<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Comment::create([
                'post_id' => 1,
                'name' => $faker->sentence(4),
            ]);
        }
        foreach (range(1, 15) as $index) {
            Comment::create([
                'post_id' => 2,
                'name' => $faker->sentence(6),
            ]);
        }
        foreach (range(1, 20) as $index) {
            Comment::create([
                'post_id' => 3,
                'name' => $faker->sentence(8),
            ]);
        }
        foreach (range(1, 25) as $index) {
            Comment::create([
                'post_id' => 4,
                'name' => $faker->sentence(10),
            ]);
        }

    }
}
