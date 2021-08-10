<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class PivotUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = UserRole::find(1);

        $user = [1, 2, 3];
        $userRole->users()->sync($user);

        $userRole = UserRole::find(2);

        $user = [2, 4, 6, 8];
        $userRole->users()->attach($user);

        $userRole = UserRole::find(3);

        $user = [1, 3, 7, 9];
        $userRole->users()->attach($user);
    }
}
