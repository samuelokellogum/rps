<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotedStudents extends Model
{
    protected $fillable = [
        "term_id", "clazz_id", "clazz_stream_id", "promoted_list", "not_promoted_list", "promoted"
    ];

    public function getPromotedListAttribute($value){
        return json_decode($value);
    }

    public function getNotPromotedListAttribute($value){
        return json_decode($value);
    }
}
