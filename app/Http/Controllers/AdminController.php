<?php

namespace App\Http\Controllers;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $moderatorRole = Role::findByName('moderator');
        $userRole = Role::findByName('user');

        return view('admin.index', compact('users', 'moderatorRole', 'userRole'));
    }

    public function assign(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('moderator')) {
            $user->removeRole('moderator');
            $action = 'removed';
        } else {
            $user->assignRole('moderator');
            $action = 'added';
        }

        return redirect()->route('admin.index')->with('success', "Moderator role $action for $user->name.");
    }
}


