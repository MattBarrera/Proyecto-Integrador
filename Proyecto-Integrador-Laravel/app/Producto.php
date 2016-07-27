<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = "productoId";

    public function talleHasProducto()
    {
        return $this->belongsToMany('App\Talle', 'talleHasProducto','talleId','productoId');
    }
    public function colorHasProducto()
    {
        return $this->belongsToMany('App\Color', 'colorHasProducto','colorId','productoId');
    }
    public function genero()
    {
        return $this->hasOne('App\Genero', 'generoId');
    }
    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'categoriaId', 'categoriaId');
    }
    public function usuario()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
    
}
