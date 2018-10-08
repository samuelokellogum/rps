<?php

namespace App\Http\Controllers;

use App\Clazz;
use App\ClazzStudent;
use App\ImportFile;
use App\ImportStudentTemp;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImportStudentsController extends Controller
{
    public function index(){
        return view("student.import.index");
    }

    public function importStudentFile(Request $request){
        \ImportHandler::importFile($request);
        return redirect()->route('viewStudentImport');
        //return view("student.import.temp_view");
    }


    public function getAjaxClassData(){
        return response()->json(Clazz::with("streams")->get());
    }

    public function viewStudentImport(Request $request){
        $file = ImportFile::orderBy("id", "desc")->first();

        if($file != null){
          $temp_data = $file->studentData()->orderBy("id", "asc")->orderBy("status", "desc")->get();
            return view("student.import.temp_view", compact('temp_data', 'file'));
        }

        return redirect()->back();
    }

    public function onUpdateTempData(Request $request){
        return response()->json(ImportStudentTemp::find($request->id));
    }

    public function updateTempData(Request $request){
        $temp_data = ImportStudentTemp::find($request->id);


        $data = $request->all();

        if($request->hasFile("usr_image")){

            $photo = \Util::storeFile("student/photo", $request->usr_image)->file_path;
            $data["photo"] = $photo;
        }

        $data["errors"] = null;
        $data["status"] = "accepted";
        $temp_data->update($data);

        session()->flash("swal_message",["type" => "success", "message" => "{$request->name} data has been updated"]);
        return redirect()->back();
    }

    public function confirmStudentImport(Request $request){
        $file = ImportFile::find($request->id);
        $students = $file->studentData()->where("status", "accepted")->get(["name", "dob", "gender", "photo", "guardian_name", "guardian_contact", "year_of_admin"]);

        foreach ($students as $student){

            $admin_year = ($student->year_of_admin == null) ? Carbon::now()->format("Y") : $student->year_of_admin;
            $student["reg_number"] = \Util::genRegNumber($admin_year);
            $student["year_of_admin"] = $admin_year;

            $student = Student::create($student->toArray());

            ClazzStudent::updateOrCreate([
                "student_id" => $student->id
            ],[
                "student_id" => $student->id,
                "clazz_id" => $file->clazz_id,
                "clazz_stream_id" => $file->clazz_stream,
                "year" => Carbon::now()->format("Y")
            ]);
        }


        session()->flash("toast_message", ["type" => "success", "message" => "Data Saved!!"]);
        return redirect()->route("importStudents");

    }
}
