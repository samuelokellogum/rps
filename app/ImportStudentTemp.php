<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportStudentTemp extends Model
{
    protected $fillable = [
        "name", "dob", "gender", "photo", "guardian_name", "guardian_contact", "errors", "import_file_id","status","year_of_admin"
    ];
}
