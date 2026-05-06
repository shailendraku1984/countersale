<?php

namespace App\Services\Contracts;

use App\Models\User;

interface UserServiceInterface
{
    public function listUsers();
    public function createUser(array $data): User;
    public function updateUser(User $user, array $data): User;
    public function deleteUser(User $user): void;
}