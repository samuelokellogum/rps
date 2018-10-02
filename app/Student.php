<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        "name", "reg_number", "dob", "year_of_admin", "gender", "photo", "guardian_name", "guardian_contact", "status"
    ];

    public function marks(){
        return $this->hasMany(Mark::class);
    }

    public function mark($student, $examset, $term, $subject, $subject_sub_id){
        return Mark::where("student_id", $student)->where("exam_set_id", $examset)
            ->where("term_id", $term)->where("subject_id", $subject)
            ->where("subject_sub_id", $subject_sub_id)->first();
    }

    public function clazz(){
        return $this->belongsToMany(Clazz::class, "clazz_students" ,"student_id", "clazz_id")->first();
    }

    public function reportCards(){
        return $this->hasMany(StudentReport::class);
    }
}
