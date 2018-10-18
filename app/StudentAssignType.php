<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAssignType extends Model
{
    protected $fillable = [
        "student_id", "student_type_id"
    ];
}
