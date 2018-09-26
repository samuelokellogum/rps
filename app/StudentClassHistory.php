<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClassHistory extends Model
{
    protected $fillable = [
        "clazz_id", "student_id", "year"
    ];
}
