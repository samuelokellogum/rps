<?php

namespace App\Http\Controllers;

use App\Clazz;
use App\ClazzStream;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        $title = "Classes";
        $classes = Clazz::all();
        return view("clazz.index", compact('title', 'classes'));
    }

    public function loadClassList(Request $request){
        return response()->json(Clazz::with("streams")->get());
    }

    public function addClassData(Request $request){


       $class = Clazz::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "short_name" => $request->short_name
        ]);

        return response()->json(Clazz::with("streams")->get());
    }

    public function onClassUpdate(Request $request){
        return response()->json(Clazz::find($request->id));
    }

    public function addClassStream(Request $request){
        $class_stream = ClazzStream::updateOrCreate([
            "id" => $request->id
        ],[
            "clazz_id" => $request->clazz_id,
            "name" => $request->name,
            "short_name" => $request->short_name
        ]);

        return response()->json(Clazz::with("streams")->get());
    }

    public function onClassStreamUpdate(Request $request){
        return response()->json(ClazzStream::find($request->id));
    }
}
