<?php

namespace App\Repositories;

use App\Dto\MenuDto;
use App\Models\MenuModel;

class MenuRepository
{
    public function save(MenuDto $dto)
    {
        $model = new MenuModel();
        $model->id = $dto->id;
        $model->name = $dto->name;
        $model->link = $dto->link;
        $model->icon = $dto->icon;
        $model->parent = $dto->parent;
        $model->order = $dto->order;
        return $model->save();
    }

    public function update(MenuDto $dto)
    {
        $model = MenuModel::where('id', $dto->id)->first();
        $model->name = $dto->name;
        $model->link = $dto->link;
        $model->icon = $dto->icon;
        $model->parent = $dto->parent;
        $model->order = $dto->order;
        return $model->save();
    }

    public function delete($id)
    {
        $model = MenuModel::where('id', $id)->first();
        return $model->delete();
    }

    public function findOne($id)
    {
        return MenuModel::where('id', $id)->first();
    }

    public function findAll()
    {
        return MenuModel::orderBy('order', 'asc')->get();
    }

    public function findAllParent()
    {
        return MenuModel::where('parent', 0)
            ->orWhereRaw('id = parent')
            ->orWhereRaw("link = '#'")
            ->orderBy('order', 'asc')
            ->get();
    }
}
