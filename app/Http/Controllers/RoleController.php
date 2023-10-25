<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function assignRoles(){
        $adminUser = User::find(1);
        $users = User::all();
        $adminRole = Role::findByName('admin');
        $moderatorRole = Role::findByName('moderator');
        $userRole = Role::findByName('user');

        $adminUser->assignRole($adminRole, $userRole, $moderatorRole);
        foreach ($users as $user) {
            $user->assignRole($userRole);
        }
        return redirect()->route('games.index');
    }
}
