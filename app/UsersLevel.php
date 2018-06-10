<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersLevel extends Model
{
    protected $table = 'users_level';

    protected $fillable = [
        'name'
    ];
}
