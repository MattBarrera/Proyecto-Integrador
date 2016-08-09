<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname','phone', 'email','gender','avatar','birthdate', 'password','status','roleId',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return $this->name . " " . $this->lastname;
    }

    public function genero()
    {
        return $this->hasOne('App\Genero', 'generoId');
    }
}
