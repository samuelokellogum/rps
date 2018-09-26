<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grading extends Model
{
    protected $fillable = [
        "name"
    ];

    public function details(){
        return $this->hasMany(GradingDetail::class);
    }
}
