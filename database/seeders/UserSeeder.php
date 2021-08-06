<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        $admin->assignRole(['admin']);
        $editor = User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        $editor->assignRole(['editor']);
        $viewer = User::factory()->create([
            'name' => 'Viewer',
            'email' => 'viewer@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        $viewer->assignRole(['viewer']);
    }
}
