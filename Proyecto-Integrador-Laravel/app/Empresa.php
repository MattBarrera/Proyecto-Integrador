<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'empresaId';

    protected $fillable = [
    	'empresaNombre',
        'empresaMail',
        'empresaCUIT',
        'empresaTelefono',
        'empresaDireccion',
        'empresaFoto',
        'empresaEstado',
    ];
}
