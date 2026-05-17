<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\UserAddress;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('react-token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }

    public function profile_pre (Request $request)
    {
		$user = $request->user();

		return response()->json([
			'status' => true,
			'user' => [
				'id' => $user->id,
				'name' => $user->name,
				'email' => $user->email,
				'phone' => $user->phone,
			]
		]);
		

    }
	
	public function profile(Request $request)
	{
		return response()->json([

			'status' => true,

			'data' => $request->user()->load('addresses')
		]);
	}

	
	
	public function register(Request $request)
	{
		$request->validate([

			'name' => 'required|string|max:255',

			'email' => 'required|email|unique:users,email',

			'password' => 'required|min:6|confirmed',
		]);

        //'password' => Hash::make($request->password)
		$user = User::create([

			'name' => $request->name,

			'email' => $request->email,

			'password' => bcrypt($request->password),
		]);

		/*
		|--------------------------------------------------------------------------
		| Assign User Role
		|--------------------------------------------------------------------------
		*/

		$role = Role::where(
			'name',
			'user'
		)->first();

		if ($role) {

			$user->roles()->attach($role->id);
		}

		$token = $user->createToken('auth_token')->plainTextToken;

		return response()->json([

			'status' => true,

			'token' => $token,

			'user' => $user,
		]);
	}


    public function updateProfile(Request $request)
	{
		$request->validate([

			'name' => 'required|string|max:255',

			'email' => 'required|email|unique:users,email,' . $request->user()->id,

			'phone' => 'nullable|string|max:20',
		]);

		$user = $request->user();

		$user->update([

			'name' => $request->name,

			'email' => $request->email,

			'phone' => $request->phone,
		]);

		return response()->json([

			'status' => true,

			'message' => 'Profile updated successfully',

			'user' => $user,
		]);
	}


    public function logout(Request $request)
	{
		$request->user()->currentAccessToken()->delete();

		return response()->json([
			'status' => true,
			'message' => 'Logout successful'
		]);
	}
}