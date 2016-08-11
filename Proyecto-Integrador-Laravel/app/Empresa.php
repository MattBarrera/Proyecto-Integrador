<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'empresaId';

    protected $fillable = [
    	'empresaNombre',
        'empresaEmail',
        'empresaCUIT',
        'empresaTelefono',
        'empresaDireccion',
        'empresaFoto',
        'empresaEstado',
    ];

    public function productos($empresaId){
        $productos = Producto::where('empresaId',$empresaId)->get();
        return $productos->count();
    }
    public function usuarios(){
        return $this->hasMany('App\EmpresaHasUsers','empresaId','empresaId');
    }
}
