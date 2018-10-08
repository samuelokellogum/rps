<?php

namespace App\Http\Controllers;

use App\Clazz;
use App\ClazzStream;
use App\ExamSet;
use App\Mark;
use App\Student;
use App\Term;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function index(Request $request){


        $by = $request->by;
        $id = $request->id;
        $selected_term = $request->term;
        $selected_exam = $request->exam;
        

        $class = ($request->by == "clazz") ? Clazz::find($request->id) : ClazzStream::find($request->id)->clazz ;
        $students = ($request->by == "clazz") ? Clazz::find($request->id)->students()->orderBy("name", "asc")->get()
            : ClazzStream::find($request->id)->students()->orderBy("name", "asc")->get();
        $stream = ($request->by == "stream") ? ClazzStream::find($request->id) : null ;


        //TODO check if subjects in not null
        $subjects = ($request->by == "clazz") ? $class->subjects : $stream->subjects;

        
        $terms = Term::all();
        $exam_sets = ExamSet::all();


        //return view("results.index", compact('students', 'class', 'stream', 'subjects', 'terms', 'exam_sets','by', 'id', 'selected_term', 'selected_exam'));
        return view("results.new_results.index", compact('students', 'class', 'stream', 'subjects', 'terms', 'exam_sets','by', 'id', 'selected_term', 'selected_exam'));
    }

    public function onMarksUpdate(Request $request){

        $all_data = [];

        $student = Student::find($request->id);
        $subjects = $student->clazz()->subjects;

        $exam = $request->exam;
        $term = $request->term;

        foreach ($subjects as $subject){
            $all_marks = [];
            if($subject->particulars->count() > 0){
                foreach ($subject->particulars as $particular){
                    $mark = $student->mark($student->id, $exam, $term, $subject->id, $particular->id);
                    $marks = array(
                        "mark" => ($mark != null) ? $mark->mark : null,
                        "mark_id" => ($mark != null) ? $mark->id : null,
                        "pat" => $particular->name
                    );

                    $all_marks[] = $marks;
                }
            }else{
                $mark = $student->mark($student->id, $exam, $term, $subject->id, null);
                $marks = array(
                    "mark" => ($mark != null) ? $mark->mark : null,
                    "mark_id" => ($mark != null) ? $mark->id : null,
                    "pat" => ""
                );

                $all_marks[] = $marks;
            }

            $data = array(
                "subject" => $subject,
                "marks" => $all_marks,
                "student" => $student
            );

            $all_data[] = $data;
        }

        return response()->json($all_data);
    }

    public function updateMark(Request $request){
        $mark = Mark::find($request->id);

        $exam = $request->exam;
        $term = $request->term;

        $mark->update([
            "mark" => $request->mark
        ]);
        return $this->allData($request->student, $exam, $term);
    }

    private function allData($student_id, $exam, $term){
        $all_data = [];

        $student = Student::find($student_id);
        $subjects = $student->clazz()->subjects;

        foreach ($subjects as $subject){
            $all_marks = [];
            if($subject->particulars->count() > 0){
                foreach ($subject->particulars as $particular){
                    $mark = $student->mark($student->id, $exam , $term, $subject->id, $particular->id);
                    $marks = array(
                        "mark" => ($mark != null) ? $mark->mark : null,
                        "mark_id" => ($mark != null) ? $mark->id : null,
                        "pat" => $particular->name
                    );

                    $all_marks[] = $marks;
                }
            }else{
                $mark = $student->mark($student->id, $exam, $term, $subject->id, null);
                $marks = array(
                    "mark" => ($mark != null) ? $mark->mark : null,
                    "mark_id" => ($mark != null) ? $mark->id : null,
                    "pat" => ""
                );

                $all_marks[] = $marks;
            }

            $data = array(
                "subject" => $subject,
                "marks" => $all_marks,
                "student" => $student
            );

            $all_data[] = $data;
        }

        return response()->json($all_data);
    }
}
