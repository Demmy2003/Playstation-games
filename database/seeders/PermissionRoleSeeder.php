<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class phpPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name'=>'edit games']);
        Permission::create(['name'=>'delete games']);
        Permission::create(['name'=>'create games']);
        Permission::create(['name'=>'create reviews']);
        Permission::create(['name'=>'edit reviews']);
        Permission::create(['name'=>'delete reviews']);
        Permission::create(['name'=>'delete users']);

        $admin = Role::create(['name' => 'admin']);
        $moderator = Role::create(['name'=>'moderator']);
        $user = Role::create(['name'=>'user']);


        $admin->givePermisionTo(Permission::all());
        $moderator->givePermisionTo(['edit games', 'delete games', 'create games']);
        $user->givePermisionTo(['create reviews', 'edit reviews','delete reviews']);
    }
}
