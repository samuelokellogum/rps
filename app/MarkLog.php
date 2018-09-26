<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkLog extends Model
{
    protected $fillable = [
        "exam_set_id", "term_id", "clazz_id", "subject_id", "subject_sub_id","clazz_stream_id"
    ];
}
