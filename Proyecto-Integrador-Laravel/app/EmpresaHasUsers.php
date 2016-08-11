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
    	'empresaOwner',
    ];

    public function empresa(){
    	return $this->belongsTo('App\Empresa','empresaId','empresaId');
    }
    public function usuario(){
        return $this->belongsTo('App\User','users_id','id');
    }
}
