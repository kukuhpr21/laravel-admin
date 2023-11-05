<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleValidation;
use App\Services\RoleService;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService();
    }

    public function index()
    {
        $items['datas'] = $this->roleService->findAll(true);
        return view('pages.systems.roles.list', $items);
    }

    public function create()
    {
        return view('pages.systems.roles.create');
    }

    public function store(RoleValidation $request)
    {
        $redirect = redirect()->route('create-role');
        $result = $this->roleService->save($request->validated());
        $this->createSessionFlash($request, 'create new role', $result);
        return ($result) ? redirect()->route('roles') : $redirect->withInput($request->input());
    }

    public function edit($id)
    {
        $items['data'] = $this->roleService->findById($id);
        return $items['data'] ? view('pages.systems.roles.edit', $items) : abort(404);
    }

    public function update(RoleValidation $request, $id)
    {
        $redirect = redirect()->route('edit-role', ['id' => $id]);

        if ($request->validated()) {
            $roleHasUsed = $this->roleService->roleHasUsed($id);

            if ($roleHasUsed) {
                $this->createSessionFlash($request, 'role has used', false);
                return $redirect->withInput($request->input());
            }
            $result   = $this->roleService->update($id, $request['name']);
            $this->createSessionFlash($request, 'update role', $result);
            return ($result) ? redirect()->route('roles') : $redirect->withInput($request->input());
        }
    }

    public function destroy($id)
    {
        $redirect = redirect()->route('roles');
        $roleHasUsed = $this->roleService->roleHasUsed($id);

        if ($roleHasUsed) {
            return $redirect->with('failed', 'Failed, role has used');
        }
        if ($this->roleService->delete($id)) {
            return redirect()->route('roles');
        }
    }
}
