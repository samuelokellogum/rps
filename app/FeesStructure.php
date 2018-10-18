<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeesStructure extends Model
{
    protected $fillable = [
        "term_id", "clazz_id", "student_type", "total_amount", "description"
    ];

    public function getDescriptionAttribute($value){
        return json_decode($value);
    }

    public function clazz(){
        return $this->belongsTo(Clazz::class);
    }

    public function studentType(){
        return $this->belongsTo(StudentTypes::class, 'student_type');
    }
}
