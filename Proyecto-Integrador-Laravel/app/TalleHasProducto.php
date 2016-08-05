<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalleHasProducto extends Model
{
    protected $table = 'talleHasProducto';
    protected $primaryKey = "productoId";

    public function talle()
    {
        return $this->hasOne('App\Talle', 'talleId','talleId');
    }
}
