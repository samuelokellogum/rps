<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clazz;
use App\ClassSubPats;
use App\Subject;

class ReportConfigController extends Controller
{
    public function index(Request $request){

        $clazz = Clazz::find($request->class);
        return view("report_config.index", compact('clazz'));
    }

    public function getSubjectPatsForClass(Request $request){
        $class = Clazz::find($request->clazz_id);
        return response()->json([
            "pats" => $class->patsForSubject($request->subject_id)->pluck('subject_pat_id'),
            "class"  => $class,
            "subject" => Subject::with("particulars")->where("id",$request->subject_id)->first()
        ]);
    }

    public function addPartsToClass(Request $request){
        //delete pats
        ClassSubPats::where("clazz_id", $request->clazz_id)->where("subject_id", $request->subject_id)->delete();

        foreach($request->pats as $val){
            ClassSubPats::create([
                "clazz_id" => $request->clazz_id,
                "subject_id" => $request->subject_id,
                "subject_pat_id" => $val
            ]);
        }
    }

    public function reportConfig(Request $request){

    }
}
