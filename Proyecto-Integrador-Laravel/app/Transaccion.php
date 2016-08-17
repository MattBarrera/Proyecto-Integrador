<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transacciones';
    protected $primaryKey = 'transaccionId';
    protected $fillable = [
    	'productoId',
    	'transaccionQty',
    	'transaccionPrice',
    	'transaccionSize',
    	'transaccionColor',
    	'transaccionName',
        'userId',
    ];
}
