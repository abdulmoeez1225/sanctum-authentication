<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        //


        $viewer = Permission::create(['name' => 'can.view']);
        $editor = Permission::create(['name' => 'editor']);
        $administrator = Permission::create(['name' => 'administrator']);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo($administrator);

        $roleOwner = Role::create(['name' => 'editor']);
        $roleOwner->givePermissionTo($editor);

        $roleOwner = Role::create(['name' => 'viewer']);
        $roleOwner->givePermissionTo($viewer);

    }
}
