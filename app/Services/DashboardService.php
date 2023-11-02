<?php

namespace App\Services;

use App\Repositories\UserRepository;

class DashboardService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
}
