<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTracker extends Model
{
    protected $fillable = [
        "student_id", "term_id", "balance"
    ];
}
