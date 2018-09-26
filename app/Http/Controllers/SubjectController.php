<?php

namespace App\Http\Controllers;

use App\Clazz;
use App\ClazzSubject;
use App\Subject;
use App\SubjectParticular;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(){
        $title = "Subject";
        return view("subject.index", compact('title'));
    }

    public function addSubject(Request $request){

        $subject = Subject::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "short_name" => $request->short_name
        ]);

        return response()->json(Subject::with("particulars")->get());

    }

    public function onSubjectUpdate(Request $request){
        return response()->json(Subject::find($request->id));
    }

    public function addSubjectPat(Request $request){

        $sub_pat = SubjectParticular::updateOrCreate([
            "id" => $request->id
        ],[
            "subject_id" => $request->subject_id,
            "name" => $request->name,
            "short_name" => $request->short_name
        ]);
        return response()->json(Subject::with("particulars")->get());

    }

    public function onSubjectPatUpdate(Request $request){
        return response()->json(SubjectParticular::find($request->id));
    }

    public function loadAllSubjects(Request $request){
        return response()->json(Subject::with("particulars")->get());
    }

    public function classSubject(Request $request){
        $classes = Clazz::all();
        return view("subject.class_subjects", compact("classes"));
    }

    public function loadAllClassWithSubjects(Request $request){
        $data = [
            "class_with_subjects" => Clazz::with("subjects")->get(),
            "subjects" => Subject::all()
        ];
        return response()->json($data);
    }

    public function addClassSubject(Request $request){

        $data = $request->subjects;

        ClazzSubject::where("clazz_id", $request->clazz_id)->delete();

        if(count($data) > 0){
            foreach ($data as $row){
                ClazzSubject::create([
                    "clazz_id" => $request->clazz_id,
                    "subject_id" => $row
                ]);
            }
        }


        $data = [
            "class_with_subjects" => Clazz::with("subjects")->get(),
            "subjects" => Subject::all()
        ];
        return response()->json($data);
    }
}
