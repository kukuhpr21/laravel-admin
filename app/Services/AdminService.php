<?php

namespace App\Services;

use App\Repositories\UserRepository;

class AdminService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function findAllAdmin()
    {
        return $this->userRepository->findAllByRole('admin');
    }

    public function findAllUser()
    {
        return $this->userRepository->findAllByRole('user');
    }

    public function changeRoleAdmin($id)
    {
        return $this->userRepository->changeRole($id, 'admin');
    }

    public function changeRoleUser($id)
    {
        return $this->userRepository->changeRole($id, 'user');
    }
}
