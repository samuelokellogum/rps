<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        "name", "short_name"
    ];

    public function particulars(){
        return $this->hasMany(SubjectParticular::class);
    }


}
