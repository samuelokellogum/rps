<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClazzSubject extends Model
{
        protected $fillable = [
            "clazz_id", "subject_id"
        ];
}
