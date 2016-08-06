<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaHasUsers extends Model
{
    protected $table = 'empresaHasUsers';
    protected $primaryKey = 'empresaId';
    protected $fillable = [
    	'empresaId',
    	'users_id',
    ];
}
