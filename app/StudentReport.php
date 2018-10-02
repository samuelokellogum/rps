<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
    protected $fillable = [
        "student_id", "term_id", "clazz_id", "full_report"
    ];

    public function getFullReportAttribute($value){
        return json_decode($value);
    }
}
