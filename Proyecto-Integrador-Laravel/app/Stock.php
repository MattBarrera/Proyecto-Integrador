<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';
    protected $primaryKey = 'stockId';
    protected $fillable = [
    	'talleId',
    	'colorId',
    	'stockCantidad',
    	'productoId',
    ];

    public function color(){
    	return $this->hasOne('App\Color','colorId','colorId');
    }
    public function talle(){
    	return $this->hasOne('App\Talle','talleId','talleId');
    }
}
