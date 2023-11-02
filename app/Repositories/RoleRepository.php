<?php

namespace App\Repositories;

use App\Models\RoleModel;

class RoleRepository
{

    public function save($id, $name)
    {
        $model = new RoleModel();
        $model->id = $id;
        $model->name = $name;
        return $model->save();
    }

    public function update($id, $name)
    {
        $model = RoleModel::where('id', $id)->first();
        $model->name = $name;
        return $model->save();
    }

    public function delete($id)
    {
        $model = RoleModel::where('id', $id)->first();
        return $model->delete();
    }

    public function findOne($id)
    {
        return RoleModel::where('id', $id)->first();
    }

    public function findAll()
    {
        return RoleModel::all();
    }

    public function findAllNotSuperAdmin()
    {
        return RoleModel::whereNotIn('id', ['superadmin'])->get();
    }
}
