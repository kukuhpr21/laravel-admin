<?php

namespace App\Repositories;

use App\Dto\UserDto;
use App\Models\UserModel;

class UserRepository
{
    public function save(UserDto $dto)
    {
        $model = new UserModel();
        $model->id = $dto->id;
        $model->role_id = $dto->role_id;
        $model->email = $dto->email;
        $model->password = $dto->password;
        $model->created_at = $dto->created_at;
        $model->updated_at = $dto->updated_at;
        return $model->save();
    }

    public function update(UserDto $dto)
    {
        $model = UserModel::where('id', $dto->id)->first();
        $model->role_id = $dto->role_id;
        $model->email = $dto->email;
        $model->password = $dto->password;
        $model->created_at = $dto->created_at;
        $model->updated_at = $dto->updated_at;
        return $model->save();
    }

    public function changeRole($id, $roleId)
    {
        $model = UserModel::where('id', $id)->first();
        $model->role_id = $roleId;
        return $model->save();
    }

    public function changePassword($id, $password)
    {
        $model = UserModel::where('id', $id)->first();
        $model->password = $password;
        return $model->save();
    }

    public function delete($id)
    {
        $model = UserModel::where('id', $id)->first();
        return $model->delete();
    }

    public function findOne($id)
    {
        return UserModel::with('employee')->whereNot('role_id', ['superadmin', 'admin'])->where('id', $id)->first();
    }

    public function findByEmail($email)
    {
        return UserModel::where('email', $email)->first();
    }

    public function findAllByRole($roleId)
    {
        return UserModel::with('employee')->where('role_id', $roleId)->get();
    }

    public function findAll($showSuperAdmin = true)
    {
        $roles = ['superadmin', 'admin'];

        if ($showSuperAdmin) {
            unset($roles[0]);
        }
        return UserModel::with('employee')->whereNot('role_id', $roles)->get();
    }
}
