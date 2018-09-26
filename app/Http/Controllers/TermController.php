<?php

namespace App\Http\Controllers;

use App\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TermController extends Controller
{

    public function index(){
        return view("term.index");
    }

    public function addTerm(Request $request){


        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        if($start->greaterThanOrEqualTo($end)){
            return response()->json(["type" => "error", "message" => "Term start can't be greater than or equal to Term end"]);
        }

        Term::updateOrCreate([
            "id" => $request->id
        ], [
            "name" => $request->name,
            "year" => $request->year,
            "start" => $request->start,
            "end" => $request->end
        ]);

        return response()->json(Term::all());

    }

    public function onTermUpdate(Request $request){
        return response()->json(Term::find($request->id));
    }

    public function loadAllTerms(Request $request){
        return response()->json(Term::all());
    }

}
