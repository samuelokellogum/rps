<?php

namespace App\Http\Controllers;

use App\ExamSet;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Request $request){
        $examSets = ExamSet::all();
        return view("exam.index", compact("examSets"));
    }

    public function addEXamSet(Request $request){

        ExamSet::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "short_name" => $request->short_name,
            "total_mark" => $request->total_mark
        ]);


        //session()->flash("swal_message",["type" => "success", "message" => "Data Saved!!"]);
        session()->flash("toast_message",["type" => "success", "message" => "Data Saved!!"]);
        return redirect()->back();

    }

    public function onExamSetUpdate(Request $request){
        return response()->json(ExamSet::find($request->id));
    }
}
