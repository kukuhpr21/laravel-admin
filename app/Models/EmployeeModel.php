<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;
    protected $table      = 'employees';
    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;
    protected $guarded    = [];

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
