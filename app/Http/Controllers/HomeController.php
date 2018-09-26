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
        return view('home');
    }

    public function regSchool(){
        return view("school.index");
    }

    public function addSchoolData(Request $request){

        if($request->hasFile("usr_image")){
            $file = \Util::storeFile("school/badge/", $request->usr_image);
            $badge = $file->file_path;
        }else{
            $badge = School::find(1)->badge;
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
        dd($request->all());
    }
}
