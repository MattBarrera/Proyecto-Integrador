<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'genero';
    protected $primaryKay = 'generoId';
    protected $fillable = ['generoNombre',];
    
}
