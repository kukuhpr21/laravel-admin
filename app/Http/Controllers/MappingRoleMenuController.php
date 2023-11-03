<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleMenuValidation;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Services\RoleMenuService;
use App\Services\RoleService;

class MappingRoleMenuController extends Controller
{
    private MenuService $menuService;
    private RoleService $roleService;
    private RoleMenuService $roleMenuService;
    private $roles;
    private $menus;

    public function __construct()
    {
        $this->menuService = new MenuService();
        $this->roleService = new RoleService();
        $this->roleMenuService = new RoleMenuService();
        $this->roles = $this->roleService->findAll(true);
        $this->menus = $this->menuService->findAll();
    }

    public function index()
    {
        $items['base_menu']     = $this->menuService->createTreeMenu();
        $items['menu_role']     = '';
        $items['roles']         = $this->roles;
        $items['role']          = '';
        $items['menus']         = '';
        $items['menu_selected'] = '';
        return view('pages.systems.mapping.role_menu', $items);
    }

    public function show(Request $request)
    {
        $roleId                 = $request->role;
        $items['base_menu']     = $this->menuService->createTreeMenu();
        $items['menu_role']     = ($roleId) ? $this->menuService->createTreeMenu($roleId) : '';
        $items['roles']         = $this->roles;
        $items['role']          = $request->role;
        $items['menus']         = ($roleId) ? $this->menus : '';
        $items['menu_selected'] = ($roleId) ? $this->roleMenuService->findAllByRole($roleId) : '';
        return view('pages.systems.mapping.role_menu', $items);
    }


    public function create(Request $request)
    {
        $roleId                 = $request->role;
        $items['base_menu']     = $this->menuService->createTreeMenu();
        $items['menu_role']     = ($roleId) ? $this->menuService->createTreeMenu($roleId) : '';
        $items['roles']         = $this->roles;
        $items['role']          = $request->role;
        $items['menus']         = ($roleId) ? $this->menus : '';
        $items['menu_selected'] = ($roleId) ? $this->roleMenuService->findAllByRole($roleId) : '';
        return view('pages.systems.mapping.role_menu', $items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleMenuValidation $request)
    {
        $redirect = redirect()->route('create-mapping-role-menu');
        $result   = $this->roleMenuService->save($request->validated());
        $this->createSessionFlash($request, 'create mapping role menu', $result);

        if ($result) {
            $this->menuService->createCacheMenuRole($request['role_selected']);
            return $redirect;
        } else {
            return $redirect->withInput($request->input());
        }
    }

    /**
     * Reset a resource in storage.
     */
    public function reset(Request $request)
    {
        $roleId   = $request->reset_role_selected;
        $redirect = redirect()->route('role-menu');
        $this->roleMenuService->reset($roleId);
        $this->createSessionFlash($request, 'reset mapping role menu', true);
        $this->menuService->createCacheMenuRole($roleId);
        return $redirect;
    }
}
