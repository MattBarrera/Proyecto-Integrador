<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = 'followers';
    // protected $primaryKey = 'users_id';

    protected $fillable = [
        'users_id', 'users_id1',
    ];
}
