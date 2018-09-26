<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clazz extends Model
{
    protected $fillable = [
        "name", "short_name"
    ];

    public function streams(){
        return $this->hasMany(ClazzStream::class);
    }

    public function students(){
        return $this->belongsToMany(Student::class,'clazz_students','clazz_id', 'student_id');
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class, "clazz_subjects", "clazz_id", "subject_id");
    }

    public function subPats(){
        return $this->hasMany(ClassSubPats::class, "clazz_id");
    }

    public function patsForSubject($subject_id){
        return $this->subPats()->where("subject_id", $subject_id)->get();
    }
}
