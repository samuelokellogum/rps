<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clazz;
use App\ClazzStream;
use App\Term;
use ReportHelper;
use App\Student;
use App\School;
use Carbon\Carbon;

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

    public function viewGenReports(Request $request){
        return view('report.gen_reports');
    }

    public function generateReports(Request $request){

        $id = (isset($request->clazz_stream)) ? $request->clazz_stream : explode("-",$request->clazz_id)[0];
        $by = (isset($request->clazz_stream)) ? "stream" : "clazz";
        $term  = $request->term_id;

       
        if($request->force_generation != 'yes'){
            $pStudents = \App\PromotedStudents::where("clazz_id", explode("-",$request->clazz_id)[0])
                                                ->where("term_id", $request->term_id)
                                                 ->where("clazz_stream_id", $request->clazz_stream)->first();

                                                

            if($pStudents != null){
                return response()->json(['error' => 'true', 'message' => 'Reports already generated ']);
            }
        }
        
         

        $data = ReportHelper::determingPosition($id, $by, $term, $request->passing_by, $request->passing_value, $request->passing_criteria);

        if($data instanceof \App\PromotedStudents){
            // $logs = \App\StudentReportLogs::updateOrCreate([
            //     "clazz_id" => explode("-",$request->clazz_id)[0], 
            //     "term_id" => $request->term_id,
            //      "clazz_stream_id" => $request->clazz_stream
            // ],[

            //     "clazz_id" => explode("-",$request->clazz_id)[0], 
            //     "term_id" => $request->term_id,
            //      "clazz_stream_id" => $request->clazz_stream,
            //      "generated" => Carbon::now()->format('Y-m-d')

            // ]);
            return response()->json($data);
        }

        $error = explode(':', $data);

         return response()->json(['error'=> 'true', 'message' => $error[1]]);

        
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
