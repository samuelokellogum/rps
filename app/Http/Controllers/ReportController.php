<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function studentReport(Request $request){
        return view("report.templates.report_2");
    }
}
