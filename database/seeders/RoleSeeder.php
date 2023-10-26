<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::findByName('admin');
        $moderator = Role::findByName('moderator');
        $user = Role::findByName('user');
        $admin->givePermissionTo(Permission::all());
        $moderator->givePermissionTo(['edit games', 'delete games', 'create games']);
        $user->givePermissionTo(['create reviews', 'edit reviews', 'delete reviews']);

    }
}
