<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenuModel extends Model
{
    use HasFactory;
    protected $table      = 'role_menu';
    protected $primaryKey = ['role_id', 'menu_id'];
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;
    protected $guarded    = [];

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'id', 'role_id');
    }

    public function menu()
    {
        return $this->belongsTo(MenuModel::class, 'menu_id', 'id');
    }
}
