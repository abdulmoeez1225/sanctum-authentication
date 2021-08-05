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


        $viewer = Permission::create(['name' => 'Can see']);
        $editor = Permission::create(['name' => 'Editor']);
        $administrator = Permission::create(['name' => 'Administrator']);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo($administrator);

        $roleOwner = Role::create(['name' => 'editor']);
        $roleOwner->givePermissionTo($editor);

        $roleOwner = Role::create(['name' => 'viewer']);
        $roleOwner->givePermissionTo($viewer);

    }
}
