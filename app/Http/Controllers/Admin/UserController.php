<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Contracts\UserServiceInterface;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService
    ) {}

    public function index()
    {
        $users = $this->userService->listUsers();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
		$roles = \App\Models\Role::where('name', '!=','super_admin')->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('admin.users.index')
            ->with('success', 'User created');
    }

    public function edit(User $user)
    {
		$roles = \App\Models\Role::where('name','!=','super_admin')->get();
        return view('admin.users.edit',compact('user','roles'));

    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->updateUser($user, $request->validated());

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return back()->with('success', 'User deleted');
    }
}