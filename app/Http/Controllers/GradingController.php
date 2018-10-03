<?php

namespace App\Http\Controllers;

use App\Grading;
use App\GradingDetail;
use Illuminate\Http\Request;
use Util;

class GradingController extends Controller
{
    public function index(){
        return view("grading.index");
    }

    public function addGrading(Request $request){
        $g = Grading::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name
        ]);

        return response()->json(Grading::with("details")->get());
    }

    public function onGradingUpdate(Request $request){
        return response()->json(Grading::find($request->id));
    }

    public function addGradeDetails(Request $request){

        $grade = Grading::find($request->grading_id);
        $details = $grade->details;

        $mark_start = $request->mark_start;
        $mark_end = $request->mark_end;
        if($mark_end > $mark_start){
            $mark_start_ = $mark_end;
            $mark_end_ = $mark_start;
        }else{
            $mark_start_ = $mark_start;
            $mark_end_ = $mark_end;
        }

        foreach ($details->pluck("mark_end", "mark_start") as $key => $val){
            if(Util::in_range($mark_start_, $val, $key) && (!isset($request->id))){

                return response()->json(["type" => "fail", "message" => "Marks defined already in range {$key} - {$val}"]);
            }
        }

        $gd = GradingDetail::updateOrCreate([
            "id" => $request->id
        ],[
            "grading_id" => $request->grading_id,
            "mark_start" => $mark_start_,
            "mark_end" => $mark_end_,
            "symbol" => $request->symbol,
            "consist_of" => $request->consist_of,
            "comment" => $request->comment
        ]);

        return response()->json(Grading::with("details")->get());
    }

    public function onGradeDetailUpdate(Request $request){
        return response()->json(GradingDetail::find($request->id));
    }

    public function loadAllGrading(Request $request){
        return response()->json(Grading::with("details")->get());
    }
}
