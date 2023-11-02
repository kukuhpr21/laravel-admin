<?php

namespace App\Repositories;

use App\Models\RoleMenuModel;
use Illuminate\Contracts\Database\Eloquent\Builder;

class RoleMenuRepository
{
    public function findAllByRole($roleId)
    {
        return RoleMenuModel::where('role_id', $roleId)->get();
    }

    public function saveBatch($datas)
    {
        return RoleMenuModel::insert($datas);
    }

    public function deletebyRole($roleId)
    {
        return RoleMenuModel::where('role_id', $roleId)->delete();
    }

    public function getDetailMenuByRole($roleId)
    {
        return collect(RoleMenuModel::with(['menu' => function (Builder $query) {
            $query->orderBy('order', 'asc');
        }])->where('role_id', $roleId)->get()->pluck('menu'))->sortBy('order')->all();
    }
}
