<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserRoleController extends Controller
{
    public function show(User $user)
	{
		$roles = Role::all();
		$userRoles = $user->roles->pluck('id')->toArray();

		return view('admin.rbac.users.assign-role', compact('user', 'roles', 'userRoles'));
	}
}