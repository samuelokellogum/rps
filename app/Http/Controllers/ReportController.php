<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clazz;
use App\ClazzStream;
use App\Term;
use ReportHelper;
use App\Student;
use App\School;

class ReportController extends Controller
{

    public function index(Request $request){
        $clazz = ($request->by == "clazz") ? Clazz::find($request->id) : ClazzStream::find($request->id)->clazz;
        $students = ($request->by == "clazz") ? Clazz::find($request->id)->students()->orderBy("name", "asc")->get()
            : ClazzStream::find($request->id)->students()->orderBy("name", "asc")->get();

        $terms = Term::all();
        $by = $request->by;
        $id = $request->id;
         
        return view("report.index", compact('clazz', 'students', 'terms', 'by', 'id'));    
    }

    public function generateReports(Request $request){
       
        $data = ReportHelper::determingPosition($request->id, $request->by, $request->term);
        return response()->json($data);
        return response()->json($request->all());
       
    }

    public function studentReport(Request $request){
        $student = Student::find($request->student_id);
        $results = $student->reportCards[0];
        $school = School::find(1);
        $term = Term::find($results->term_id);
        return view("report.templates.report_3", compact('student', 'results', 'school', 'term'));
    }

    public function printReports(Request $request){
        $data = [];
        $clazz = \App\Clazz::find($request->clazz);
        $school = \App\School::find(1);
        $term = \App\Term::find($request->term);
        foreach($request->students as $student_id){
            $student = Student::find($student_id);
            $report = $student->reportCards()->where("term_id", $request->term)->where("clazz_id", $request->clazz)->first();
            $data[] = [ "student" => $student, "report" => $report ];
        }

        $final_data = ["student_data" => $data, "clazz" => $clazz, "school" => $school, "term" => $term];
        return response()->json($final_data);
    }
}
