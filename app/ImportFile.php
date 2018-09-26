<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportFile extends Model
{
    protected $fillable = [
        "file_path", "clazz_stream", "clazz_id"
    ];

    public function studentData(){
        return $this->hasMany(ImportStudentTemp::class);
    }
}
