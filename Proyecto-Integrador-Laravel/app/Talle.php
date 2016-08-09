<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talle extends Model
{
    protected $table = 'talle';
	protected $primaryKey = 'talleId';

	protected $fillable = [
		'talleNombre',
	];
}
