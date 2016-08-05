<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorHasProducto extends Model
{
    protected $table = 'colorHasProducto';
    protected $primaryKey = 'productoId';
    
    public function color()
    {
        return $this->hasOne('App\Color', 'colorId','colorId');
    }
}
