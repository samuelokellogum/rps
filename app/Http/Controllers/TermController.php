<?php

namespace App\Http\Controllers;

use App\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


        if(!isset($request->id)){
            foreach (Term::all() as $term) {
                if ($start->greaterThanOrEqualTo(Carbon::parse($term->start)) && $start->lessThanOrEqualTo(Carbon::parse($term->end))) {
                    return response()->json(["type" => "error", "message" => "Term range already defined in {$term->name} {$term->year}"]);
                }

                if ($end->greaterThanOrEqualTo(Carbon::parse($term->start)) && $end->lessThanOrEqualTo(Carbon::parse($term->end))) {
                    return response()->json(["type" => "error", "message" => "Term range already defined in {$term->name} {$term->year}"]);
                }

                if (Carbon::parse($term->start)->greaterThanOrEqualTo(Carbon::parse($start)) && Carbon::parse($term->start)->lessThanOrEqualTo(Carbon::parse($end))) {
                    return response()->json(["type" => "error", "message" => "Term range already defined in {$term->name} {$term->year}"]);
                }

                if (Carbon::parse($term->end)->greaterThanOrEqualTo(Carbon::parse($start)) && Carbon::parse($term->end)->lessThanOrEqualTo(Carbon::parse($end))) {
                    return response()->json(["type" => "error", "message" => "Term range already defined in {$term->name} {$term->year}"]);
                }


            }
        }
       

        $today = Carbon::now();
        $status = "inactive";
        if ($today->greaterThanOrEqualTo(Carbon::parse($start)) && $today->lessThanOrEqualTo(Carbon::parse($end))) {
            $status = 'active';
        }

        if($status == 'active'){
            DB::table('terms')->update(['status' => "inactive"]);
        }


        Term::updateOrCreate([
            "id" => $request->id
        ], [
            "name" => $request->name,
            "year" => Carbon::parse($request->start)->format('Y'),
            "start" => $request->start,
            "end" => $request->end,
            "status" => $status
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
