<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable = [
        "student_id", "exam_set_id", "term_id", "clazz_id", "subject_id", "subject_sub_id", "mark"
    ];


}
