<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClazzStudent extends Model
{
    protected $fillable = [
        "clazz_id", "clazz_stream_id", "student_id", "year"
    ];
}
