<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuValidation;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private MenuService $menuService;
    private $menuParents;

    public function __construct()
    {
        $this->menuService = new MenuService();
        $this->menuParents = $this->menuService->findAllParent();
    }

    public function index()
    {
        $items['datas'] = $this->menuService->findAll();
        return view('pages.systems.menus.list', $items);
    }

    public function create()
    {
        $items['menu_parents'] = $this->menuParents;
        $items['base_menu']    = $this->menuService->createTreeMenu();
        return view('pages.systems.menus.create', $items);
    }

    public function store(MenuValidation $request)
    {
        $redirect = redirect()->route('create-menu');
        if ($request->validated()) {
            $result   = $this->menuService->save($request->all());
            $this->createSessionFlash($request, 'create new menu', $result);
            return ($result) ? redirect()->route('menus') : $redirect->withInput($request->input());
        }
    }

    public function edit($id)
    {
        $items['menu_parents'] = $this->menuParents;
        $items['base_menu']    = $this->menuService->createTreeMenu();
        $items['data']         = $this->menuService->findById($id);
        return $items['data'] ? view('pages.systems.menus.edit', $items) : abort(404);
    }

    public function update(MenuValidation $request, $id)
    {
        $redirect = redirect()->route('edit-menu', ['id' => $id]);
        if ($request->validated()) {
            $result   = $this->menuService->update($id, $request->all());
            $this->createSessionFlash($request, 'update menu', $result);
            return ($result) ? redirect()->route('menus') : $redirect->withInput($request->input());
        }
    }

    public function destroy($id)
    {
        if ($this->menuService->delete($id)) {
            return redirect()->route('menus');
        }
    }

    public function getCacheMenu($segments)
    {
        echo $this->menuService->getCacheMenuRole($segments);
    }
}
