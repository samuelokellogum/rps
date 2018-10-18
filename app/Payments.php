<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
        "term_id", "student_id", "amount_to_pay", "amount_paid", "balance", "fee_for"
    ];

    public function getFeeForAttribute($value){
        return json_decode($value);
    }
}
