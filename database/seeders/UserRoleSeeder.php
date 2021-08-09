<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            UserRole::create([
                'name' => $faker->sentence(4),
            ]);
        }
    }
}
