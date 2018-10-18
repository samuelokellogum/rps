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

    public function studentType(){
        return $this->belongsToMany(StudentTypes::class, 'student_assign_types', 'student_id', 'student_type_id');
    }

    public function payments(){
        return $this->hasMany(Payments::class);
    }

    public function paymentTracks(){
        return $this->hasMany(PaymentTracker::class);
    }

    public function feesStatus($the_term = null){

        $payment_tracks = $this->paymentTracks;
         $student_clazz = $this->clazz();
        $student_type = $this->studentType()->first();

        $term = ($the_term != null) ? Term::find($the_term) : Term::where('status', 'active')->first();
        $fs = $student_clazz->feeStructure()->where("term_id", $term->id)->where("clazz_id", $student_clazz->id)
            ->where("student_type", $student_type->id)->first();

     
        $balance = 0;
        if($payment_tracks->count() > 0){
            foreach($payment_tracks as $payment_track){
                $balance += $payment_track->balance;
            }
        }


        return [
            "balance" => $balance,
            "amount_to_pay" => ($fs == null) ? "Fees Structure error" : $fs->total_amount,
        ];
    }

    public function statement($term){
        $payments = $this->payments()->where('term_id', $term)->get();
        if($payments->count() > 0){
            $payment_track = $this->paymentTracks()->where('term_id', $term)->first();
            $balance = $payment_track->balance;

            return [
                "school" => School::find(1),
                "student" => $this,
                "term" => Term::find($term),
                "payments" => $payments,
                "balance" => $balance
            ];
        }

        return [
                "school" => School::find(1),
                "student" => $this,
                "term" => Term::find($term),
                "payments" => $payments,
                "balance" => $this->feesStatus($term)["amount_to_pay"],
            ];
    }
}
