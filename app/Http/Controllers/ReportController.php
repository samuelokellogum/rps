<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clazz;
use App\ClazzStream;
use App\Term;
use ReportHelper;
use App\Student;

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
    
        return view("report.templates.report_2", compact('student', 'results'));
    }
}
