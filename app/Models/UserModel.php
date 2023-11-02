<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table      = 'users';
    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;
    protected $guarded    = [];

    public function role()
    {
        return $this->hasOne(RoleModel::class, 'id', 'role_id');
    }

    public function transaction()
    {
        return $this->hasMany(TransactionModel::class);
    }
}
