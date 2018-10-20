<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    protected $fillable = [
        "username", "email", "password"
    ];

    protected $hidden = [
        "password"
    ];
    
}
