<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = "productoId";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'productoNombre',
        'productoDescripcion',
        'productoPrecio',
        'categoriaIdParent',
        'categoriaId',
        'productoFoto',
        'productoEstado',
        'users_id',
        'empresaId',
        'generoId',
    ];

    // public function talle()
    // {
    //     return $this->hasManyThrough('App\Talle', 'talleHasProducto','talleId','productoId');
    // }
    public function color()
    {
        return $this->belongsToMany('App\Color','colorHasProducto','productoId','colorId');
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
