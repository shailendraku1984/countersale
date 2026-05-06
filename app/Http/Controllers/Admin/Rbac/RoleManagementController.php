<?php

namespace App\Http\Controllers\Admin\Rbac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleManagementController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.rbac.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('module');
        return view('admin.rbac.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('rbac.roles.index')
            ->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy('module');
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.rbac.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('rbac.roles.index')
            ->with('success', 'Role updated successfully');
    }
}