<?php

namespace App\Http\Controllers;

use App\StudentTypes;
use App\Student;
use App\Term;
use App\Payments;
use App\OtherFees;
use App\Clazz;
use App\FeesStructure;
use App\StudentAssignType;
use App\PaymentTracker;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function index(){
        return view('fees.index');
    }

    public function allFeesData(Request $request){
        $studentTypes = StudentTypes::all();
        $otherFees = OtherFees::all();
        $clazzes = Clazz::all();
        $feesStructs = FeesStructure::with('clazz', 'studentType')->orderBy("clazz_id")->get();
        

        return response()->json([
            "student_types" => $studentTypes,
            "other_fees" => $otherFees,
            "clazzes" => $clazzes,
            "all_fees" => $feesStructs
        ]);
    }

    public function addStudentType(Request $request){

        $studentType = StudentTypes::updateOrCreate([
            'id' => $request->id
        ], [
            'name' => $request->name
        ]);

        return $this->allFeesData($request);
    }

    public function addOtherFees(Request $request){
        $otherFees = OtherFees::updateOrCreate([
            'id' => $request->id
        ], [
            'name' => $request->name,
            'amount' => \Util::formatCurrency($request->amount)
        ]);
        return $this->allFeesData($request);
    }

    public function confirmFeesStruct(Request $request){

        $description = [];
        $total_other_fees = 0;
        if(count($request->other_fees) > 0){
            foreach($request->other_fees as $oF){
                $otherFee = OtherFees::find($oF);
                $description[$otherFee->name] = \Util::formatCurrency($otherFee->amount);
                $total_other_fees += \Util::formatCurrency($otherFee->amount);
            }
        }

        $description["school_fees"] = \Util::formatCurrency($request->school_fees);

        $fs = FeesStructure::updateOrCreate([
            "term_id" => $request->term,
            "clazz_id" => $request->clazz,
            "student_type" => $request->student_type
        ],[
            "term_id" => $request->term,
            "clazz_id" => $request->clazz,
            "student_type" => $request->student_type,
            "total_amount" =>  \Util::formatCurrency($request->school_fees)+$total_other_fees,
            "description" => json_encode($description)
        ]);
        return $this->allFeesData($request);
    }

    public function FeeStudenList(Request $request){
        $clazz = Clazz::find($request->id);
        // $students = $clazz->students;
        return view('fees.student_list', compact('clazz'));
    }

    public function getStudentList(Request $request){
         $clazz = Clazz::find($request->id);
        $students = $clazz->students()->with('studentType')->get();
        $student_types = StudentTypes::all();
        $otherFees = OtherFees::all();
        return response()->json([
            "students" => $students, 
            "student_types" => $student_types,
            "other_fees" => $otherFees
            ]);
    }

    public function assignStudentType(Request $request){
        foreach($request->list as $data){
            $format_data = explode('-', $data);
            StudentAssignType::updateOrCreate([
                "student_id" => $format_data[1]
            ],[
                "student_id" => $format_data[1],
                "student_type_id" => $format_data[0]
            ]);
        }

        return $this->getStudentList($request);
    }

    public function showPay(Request $request){
        $student = Student::find($request->student_id);
        return response()->json($student->feesStatus());
    }

    public function showStatement(Request $request){
        $student = Student::find($request->student_id);
        $term = ($request->term == null) ? Term::where('status', 'active')->first()->id : $request->term;
        return response()->json($student->statement($term));
    }

    public function confirmPayment(Request $request){
        $student = Student::find($request->student_id);
        $student_type = $student->studentType()->first();
        $term = Term::find($request->term_id);
        $clazz = Clazz::find($request->clazz_id);
        $paid = \Util::formatCurrency($request->amount);

        $fs = $clazz->feeStructure()->where("term_id", $term->id)->where("clazz_id", $clazz->id)
        ->where("student_type", $student_type->id)->first();

        if($fs == null){
            return response()->json(["error" => "Error in fees structure for {$clazz->name} {$student_type->name}  {$term->name} "]);
        }

        $payments = $student->payments();
        $term_payments = $payments->where("term_id", $term->id)->get();

        $amount_to_pay = $fs->total_amount;
        $amount_paid = $paid;

        $fee_for = [];
        if(isset($request->other_fees)){
            foreach($request->other_fees as $oF){
                $otherFee = OtherFees::find($oF);
                $fee_for[] = $otherFee->name;
            }
        }

        $the_fee_for = (count($fee_for) == 0) ? null : json_encode($fee_for);
        if($term_payments->count()  == 0){
            //no payemts fo term 
            // "term_id", "student_id", "amount_to_pay", "amount_paid", "balance", "fee_for"
            $balance = $amount_to_pay - $amount_paid;


        }else{
            $last_payment = $term_payments->sortByDesc(function($data, $key){
                return $data["id"];
            })->first();

            $balance = $last_payment->balance - $amount_paid;

            
        }

        $payment = Payments::create([
            "term_id" => $term->id,
            "student_id" => $student->id,
            "amount_to_pay" => $amount_to_pay,
            "amount_paid" => $amount_paid,
            "balance" => $balance,
            "fee_for" => $the_fee_for
        ]);

        $paymentTracker = PaymentTracker::updateOrCreate([
             "term_id" => $term->id,
            "student_id" => $student->id,
        ],[
             "term_id" => $term->id,
            "student_id" => $student->id,
             "balance" => $balance
        ]);

        return response()->json([
            "payment" => $payment,
            "student" => $student
        ]);

    

        return response()->json(["success" => "Confirmed payment for {$student->name}"]);


    }

   
}
