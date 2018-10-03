<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancedGrading extends Model
{
    protected $fillable = [
        "clazz_id", "range_1", "range_2", "consist_of", "symbol", "comment"
    ];
}
