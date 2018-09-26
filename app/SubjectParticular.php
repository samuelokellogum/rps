<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectParticular extends Model
{
    protected $fillable = [
        "name", "short_name", "subject_id"
    ];
}
