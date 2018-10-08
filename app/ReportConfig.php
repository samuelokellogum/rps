<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportConfig extends Model
{
    protected $fillable = [
        "clazz_id", "grading_id", "do_avg", "position_by", "points_by", "advanced_grading", "exam_sets"
    ];

}
