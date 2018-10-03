<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClazzStream extends Model
{
    protected $fillable = [
        "clazz_id", "name", "short_name"
    ];

    public function students(){
        return $this->belongsToMany(Student::class,'clazz_students','clazz_stream_id', 'student_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, "clazz_subjects", "clazz_stream_id", "subject_id");
    }

    public function clazz(){
        return $this->belongsTo(Clazz::class);
    }
}
