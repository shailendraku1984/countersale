<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display list of roles
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy('module');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store new role
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        if ($request->permissions) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Show edit form
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy('module');
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact(
            'role',
            'permissions',
            'rolePermissions'
        ));
    }

    /**
     * Update role
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->permissions()->sync($request->permissions ?? []);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Delete role
     */
    public function destroy(Role $role)
    {
        // prevent deleting super_admin
        if ($role->name === 'super_admin') {
            return back()->with('error', 'Cannot delete Super Admin role');
        }

        $role->delete();

        return back()->with('success', 'Role deleted');
    }
}