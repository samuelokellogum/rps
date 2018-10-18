<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherFees extends Model
{
    protected $fillable = [
        "name", "amount"
    ];
}
