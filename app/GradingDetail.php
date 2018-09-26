<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradingDetail extends Model
{
    protected $fillable = [
        "mark_start", "mark_end", "symbol", "consist_of", "grading_id"
    ];
}
