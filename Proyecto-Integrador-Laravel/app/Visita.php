<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = 'visitas';
    protected $primaryKey = 'visitaId';
    protected $fillable = [
    	'productoId', 'visitaCant',
    ];
}
