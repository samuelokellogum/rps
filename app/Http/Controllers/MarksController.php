<?php

namespace App\Http\Controllers;

use App\Clazz;
use App\ClazzStream;
use App\ExamSet;
use App\Mark;
use App\MarkLog;
use App\Subject;
use App\Term;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function index(Request $request){

        /*$class = ($request->by == "class") ? Clazz::find($request->id) : ClazzStream::find($request->id)->clazz ;
        $students = ($request->by == "class") ? Clazz::find($request->id)->students()->orderBy("name", "asc")->get()
            : ClazzStream::find($request->id)->students()->orderBy("name", "asc")->get();
        $stream = ($request->by == "stream") ? ClazzStream::find($request->id) : null ;
        $subjects = $class->subjects;*/

        $sort_by = $request->by;
        $sort_id = $request->id;
        return view("marks.index", compact("sort_by","sort_id"));
    }


    public static function allExamData($request){
        $class = ($request->by == "class") ? Clazz::find($request->id) : ClazzStream::find($request->id)->clazz ;
        $students = ($request->by == "class") ? Clazz::find($request->id)->students()->orderBy("name", "asc")->get()
            : ClazzStream::find($request->id)->students()->orderBy("name", "asc")->get();
        $stream = ($request->by == "stream") ? ClazzStream::find($request->id) : null ;
        $subjects = $class->subjects()->with("particulars")->get();
        $exam_set = ExamSet::all();
        $terms = Term::all();

        return [
            "terms" => $terms,"clazz" => $class,  "students" => $students, "stream" => $stream,  "subjects" => $subjects, "exam_sets" => $exam_set
        ];
    }

    public function loadAllExamData(Request $request){
        return response()->json(self::allExamData($request));
    }

    public function onConfirm(Request $request){


        $marks_data = $request->all_content;
        $subject = $request->subject;
        $pariculars = (isset($subject["particulars"])) ? $subject["particulars"] : null;
        $selected_pats = $request->pats;

        $class = $request->clazz;
        $stream = $request->stream;

        $term = $request->term;
        $exam = $request->exam;



        $student_data = [];
        $student_data2 = [];


        $stream_id = (count($stream) > 0) ? $stream["id"] : null;

        //check if marks already in system
        if($selected_pats != null){
            foreach ($selected_pats as $pat){
                $markLog = MarkLog::where("exam_set_id", $exam["id"])->where("term_id", $term["id"])
                    ->where("clazz_id", $class["id"])->where("subject_id", $subject["id"])->where("subject_sub_id", $pat)
                ->where("clazz_stream_id", $stream_id)->first();
                if($markLog != null){
                    return response()->json(["type" => "error", "message" => "{$subject['name']} marks for {$exam['short_name']}  {$term['name']} already recorded"]);
                }else{
                    MarkLog::create([
                        "exam_set_id" => $exam["id"],
                        "term_id" => $term["id"],
                        "clazz_id" => $class["id"],
                        "clazz_stream_id" => (count($stream) > 0) ? $stream["id"] : null,
                        "subject_id" => $subject["id"],
                        "subject_sub_id" => $pat
                    ]);
                }
            }
        }else{
            $markLog = MarkLog::where("exam_set_id", $exam["id"])->where("term_id", $term["id"])
                ->where("clazz_id", $class["id"])->where("subject_id", $subject["id"])->where("clazz_stream_id", $stream_id)->first();

            if($markLog != null){
                return response()->json(["type" => "error", "message" => "{$subject['name']} marks for {$exam['short_name']} {$term['name']} already recorded"]);
            }else{
                MarkLog::create([
                    "exam_set_id" => $exam["id"],
                    "term_id" => $term["id"],
                    "clazz_id" => $class["id"],
                    "clazz_stream_id" => (count($stream) > 0) ? $stream["id"] : null,
                    "subject_id" => $subject["id"]
                ]);
            }
        }


        foreach ($marks_data as $row){
            $student = [
               "name" => $row["name"],
              "student_id" => $row["student_id"],
               "marks" => $row["marks"]
            ];


            foreach ($row["marks"] as $val){
                $data = array(
                    "student_id" => $row["student_id"],
                    "clazz_id" => $class["id"],
                    "exam_set_id" => $exam["id"],
                    "term_id" => $term["id"],
                    "subject_id" => $subject["id"],
                    "subject_sub_id" => (isset($pariculars)) ? $val["paper_id"] : null,
                    "mark" => $val["mark"]
                );

                $this->createMark($data);

                $student_data2[] = $data;
            }

            $student_data[] = $student;
        }

        return response()->json($student_data2);
    }

    private function createMark($data){
        Mark::create([
            "student_id" => $data["student_id"],
            "clazz_id" => $data["clazz_id"],
            "exam_set_id" => $data["exam_set_id"],
            "term_id" => $data["term_id"],
            "subject_id" => $data["subject_id"],
            "subject_sub_id" => $data["subject_sub_id"],
            "mark" => $data["mark"]
        ]);
    }


    public function allowedPats(Request $request){
    
        $class = Clazz::find($request->clazz_id);
        $pats = $class->patsForSubject($request->subject_id)->pluck('subject_pat_id');

        return response()->json($pats);
    }

}
