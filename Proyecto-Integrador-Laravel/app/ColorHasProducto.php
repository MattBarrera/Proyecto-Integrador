<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorHasProducto extends Model
{
    protected $table = 'colorHasProducto';
    
    public function color()
    {
        return $this->hasOne('App\Color', 'colorId','colorId');
    }
}
