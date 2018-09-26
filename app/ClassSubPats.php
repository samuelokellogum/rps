<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubPats extends Model
{
    protected $fillable = [
        "clazz_id", "subject_id", "subject_pat_id"
    ];
}
