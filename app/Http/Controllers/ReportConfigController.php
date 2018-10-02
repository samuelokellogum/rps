<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clazz;
use App\ClassSubPats;
use App\Subject;
use App\AdvancedGrading;
use App\ReportConfig;
use Util;

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

    public function getAdGrade(Request $request){
        return response()->json(AdvancedGrading::where("clazz_id", $request->clazz_id)->orderBy("consist_of", "desc")->get());
    }

    public function addAdvancedGrade(Request $request){

        $details =  AdvancedGrading::where("clazz_id", $request->clazz_id)->orderBy("consist_of", "desc")->get();

        $mark_start = $request->range_1;
        $mark_end = $request->range_2;
        if($mark_end > $mark_start){
            $mark_start_ = $mark_end;
            $mark_end_ = $mark_start;
        }else{
            $mark_start_ = $mark_start;
            $mark_end_ = $mark_end;
        }

        

        foreach ($details as $val){
            if(Util::in_range($mark_end_, $val->range_1, $val->range_2) && (!isset($request->id))){
                return response()->json(["type" => "fail", "message" => "Value defined already in range {$val->range_1} - {$val->range_2}", "ad_grades" => $details]);
            }
        }

        
        AdvancedGrading::updateOrCreate([
            "id" => $request->id
        ],[
            "symbol" => $request->symbol,
            "clazz_id" => $request->clazz_id,
            "range_1" => $request->range_1,
            "range_2" => $request->range_2,
            "consist_of" => $request->consist_of
        ]);

        $ad_grade = AdvancedGrading::where("clazz_id", $request->clazz_id)->orderBy("consist_of", "desc")->get();
          return response()->json(["type" => "success", "message" => "Done !!", "ad_grades" => $ad_grade]);
    }

    public function addReportConfig(Request $request){

        $data = $request->all();
        $data["exam_sets"] = json_encode($request->exam_sets);


       $config =  ReportConfig::updateOrCreate([
            "clazz_id" => $request->clazz_id
        ],$data);

        return response()->json($config);
    }

    public function getReportConfig(Request $request){
        return response()->json(ReportConfig::where("clazz_id", $request->clazz_id)->first());
    }
}
