<?php

namespace App\Http\Controllers;

use App\Clazz;
use App\ClazzStream;
use App\ClazzStudent;
use App\Student;
use App\StudentClassHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request){
        return view("student.index");
    }

    public function addStudent(Request $request){

        //return response()->json($request->all());


        $photo = null;
        if($request->hasFile("photo")){
            $photo = \Util::storeFile("student/photo", $request->photo)->file_path;
        }


        if(isset($request->id)){
            $student = Student::find($request->id);
            $reg_number = $student->reg_number;
            $photo = $student->photo;
            if($request->hasFile("photo")){
                $photo = \Util::storeFile("student/photo", $request->photo)->file_path;
            }

            if($student->year_of_admin != $request->year_of_admin){
                $reg_number = \Util::genRegNumber($request->year_of_admin);
            }
        }else{
            $reg_number = \Util::genRegNumber($request->year_of_admin);
        }

        $student = Student::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "reg_number" => $reg_number,
            "dob" => $request->dob,
            "year_of_admin" => $request->year_of_admin,
            "gender" => $request->gender,
            "guardian_name" => $request->guardian_name,
            "guardian_contact" => $request->guardian_contact,
            "photo" => $photo
        ]);


        ClazzStudent::updateOrCreate([
            "student_id" => $student->id
        ],[
            "student_id" => $student->id,
            "clazz_id" => $request->clazz_id,
            "clazz_stream_id" => $request->class_stream_id,
            "year" => Carbon::now()->format("Y")
        ]);

        $this->logStudentClassHistory($student->id, $request->clazz_id, Carbon::now()->format("Y"));

        return response()->json($this->allData());
    }

    public function loadAllStudents(){
        return response()->json($this->allData());
    }



    public function onStudentUpdate(Request $request){
        return response()->json(Student::find($request->id));
    }

    public function deleteStudent(Request $request){
        $student = Student::find($request->id);
        $student->delete();
        return response()->json($this->allData());
    }

    private function allData(){
        return [
            "classes" => Clazz::with("streams")->get(),
            "students" => Student::all(),
            "classes_with_data" => Clazz::with('streams.students')->get()
        ];
    }

    private function logStudentClassHistory($student_id, $clazz_id, $year){

        StudentClassHistory::updateOrCreate([
            "student_id" => $student_id,
            "clazz_id" => $clazz_id,
        ],[

            "student_id" => $student_id,
            "clazz_id" => $clazz_id,
            "year" => $year

        ]);

    }

    public function listStudentsBy(Request $request){
        $class = ($request->by == "class") ? Clazz::find($request->id) : ClazzStream::find($request->id)->clazz ;
        $students = ($request->by == "class") ? Clazz::find($request->id)->students()->orderBy("name", "asc")->get()
            : ClazzStream::find($request->id)->students()->orderBy("name", "asc")->get();
        $stream = ($request->by == "stream") ? ClazzStream::find($request->id) : null ;
        return view("student.students_by", compact('students', 'class', 'stream'));

    }
}
