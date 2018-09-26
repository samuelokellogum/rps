<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportConfig extends Model
{
    protected $fillable = [
        "clazz_id", "grading_id", "score_by", "position_by", "points_by", "advanced_grading"
    ];

}
