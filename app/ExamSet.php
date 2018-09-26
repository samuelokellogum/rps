<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamSet extends Model
{
    protected $fillable = [
        "name", "short_name"
    ];
}
