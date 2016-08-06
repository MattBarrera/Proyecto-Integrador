<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primarykey = 'categoriaId';

    protected $fillable = [
    	'categoriaNombre',
    	'categoriaIdParent',
    ];

    public function subcategorias() {
    	return $this->hasMany("App\Categoria", "categoriaIdParent", "categoriaId");
    }

    public function categoriaPadre() {
    	return $this->belongsTo("App\Categoria", "categoriaIdParent", "categoriaId");
    }
}
