<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return redirect()->route("regSchool");
        if(auth()->check()){
            return view('home');
        }
        return view('auth.login');
    }

    public function regSchool(){
        $school = School::find(1);
        return ($school != null) ? view("school.index", compact('school')) : view('school.index');
    }

    public function addSchoolData(Request $request){

        if($request->hasFile("usr_image")){
            $file = \Util::storeFile("school/badge/", $request->usr_image);
            $badge = $file->file_path;
        }else{
            $school = School::find(1);
            $badge = ($school != null) ? $school->badge : null;
        }

        if($badge == null){
            session()->flash("toast_message", ["type" => "error", "message" => "School badge missing data rejected"]);
            return redirect()->back();
        }

        School::updateOrCreate([
            "id" => 1
        ],[
            "name"=> $request->name,
            "motto" => $request->motto,
            "contact" => $request->contact,
            "address" => $request->address,
            "badge" => $badge,
            "website" => $request->website
        ]);
        session()->flash("toast_message", ["type" => "success", "message" => "School data upodated"]);
      return redirect()->back();
    }
}
