<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\Contracts\UserServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function listUsers()
    {
        return $this->userRepository->paginate();
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
		$user = $this->userRepository->create($data);
	
	    $user->roles()->sync([$data['role_id']]);
        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
		
		$user = $this->userRepository->update($user,$data);
	    $user->roles()->sync([$data['role_id']]);
        return $user;
    }

    public function deleteUser(User $user): void
    {
        $this->userRepository->delete($user);
    }
}