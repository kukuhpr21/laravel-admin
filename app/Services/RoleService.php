<?php

namespace App\Services;

use App\Repositories\RoleMenuRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class RoleService
{
    private RoleRepository $roleRepository;
    private UserRepository $userRepository;
    private RoleMenuRepository $roleMenuRepository;

    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
        $this->userRepository = new UserRepository();
        $this->roleMenuRepository = new RoleMenuRepository();
    }

    public function findAll($showSuperAdmin = false)
    {
        return $showSuperAdmin ? $this->roleRepository->findAll() : $this->roleRepository->findAllNotSuperAdmin();
    }

    public function findById($id)
    {
        return $this->roleRepository->findOne($id);
    }

    public function roleHasUsed($id)
    {
        $roleInUser = count($this->userRepository->findAllByRole($id)) > 0;
        $roleMenu = count($this->roleMenuRepository->findAllByRole($id)) > 0;
        return $roleInUser && $roleMenu;
    }

    public function save($request)
    {
        $request['id'] = strtolower($request['name']);
        return $this->roleRepository->save($request['id'], $request['name']);
    }

    public function update($id, $name)
    {
        return $this->roleRepository->update($id, $name);
    }

    public function delete(string $id)
    {
        return $this->roleRepository->delete($id);
    }
}
