<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        "name","motto", "badge", "website", "address", "contact"
    ];
}
