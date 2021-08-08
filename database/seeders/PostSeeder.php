<?php

namespace Database\Seeders;

use App\Models\Post;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            Post::create([
                'user_id' => 1,
                'title' => $faker->sentence(4),
                'body' => $faker->paragraph(4),
            ]);
        }
    }
}

