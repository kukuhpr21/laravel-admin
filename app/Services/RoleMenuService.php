<?php

namespace App\Services;

use App\Repositories\RoleMenuRepository;

class RoleMenuService
{
    private RoleMenuRepository $roleMenuRepository;

    public function __construct()
    {
        $this->roleMenuRepository = new RoleMenuRepository();
    }

    public function findAllByRole($roleId)
    {
        return $this->roleMenuRepository->findAllByRole($roleId);
    }

    public function save($request): bool
    {
        $roleId = $request['role_selected'];
        $menus  = $request['menus'];
        $role_menu = [];

        for ($i = 0; $i < count($menus); $i++) {
            $data = [
                'role_id' => $roleId,
                'menu_id' => $menus[$i],
            ];
            array_push($role_menu, $data);
        }

        $this->roleMenuRepository->deletebyRole($roleId);
        return $this->roleMenuRepository->saveBatch($role_menu);
    }
}
