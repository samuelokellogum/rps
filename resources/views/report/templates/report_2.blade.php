@extends('layouts.app')
@section('content')

<div id="printMe" class="row">

    

    <div class="col-md-12">
        <div style="text-align: center">
            <img src="{{ asset('img/school_badge.jpg') }}" style="width: 150px; height: 100px">
        </div>
        <h4 style="text-align: center">TURKISH LIGHT ACADEMY</h4>
        <h5 style="text-align: center">Term iii report 2018</h5>
    </div>

    <div class="col-md-12">
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 15%">
                        <img src="{{ ($student->photo == null) ? asset('img/userplaceholder.png') : asset('storage/{$student->photo}') }}" style="width: 100px; height: 120px">
                    </td>
                     <td>
                        <h6>Name: {{ $student->name }}</h6>
                        <h6>Class: {{ $student->clazz()->name }}</h6>
                        <h6>Position: {{ $results->full_report->position }}</h6>
                        <h6>Points: {{ $results->full_report->all_avg->points }}</h6>
                        <h6>Total : {{ $results->full_report->all_avg->total }}</h6>
                     </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="col-md-12">
            <table class="table table-striped table-bordered table-pretty">
                <thead>
                    <tr>
                        <th style="width: 20%"></th>
                        @foreach (collect($results->full_report->results)->first()->result as $key => $result)
                           <th style="width: 5%">{{ $key }}</th>
                        @endforeach
                        <th style="min-width: 10%">Final</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results->full_report->results as $key => $result)
                        <tr>
                            <td>{{ $key}}</td>
                            @foreach ($result->result as $k => $v)
                                <td class="pretty">
                                    <div class="row">
                                        @foreach ($v as $fv)
                                        <div class="col-sm-{{ round(12/count($v)) }}">
                                            {{ $fv->mark }}                                        
                                        </div>    
                                        @endforeach
                                    </div>
                                </td>
                            @endforeach

                            <td class="pretty">
                                <div class="row">
                                    <div class="col-sm-4">
                                        {{ $result->final_result->all_average->total }}
                                    </div>
                                <div class="col-sm-4">
                                    {{ $result->final_result->all_average->symbol }}
                                </div>
                                <div class="col-sm-4">
                                    {{ $result->final_result->all_average->comment }}
                                </div>
                            </div>
                                
                            </td>

                        <tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</div>

<button @click="printTest('printMe')" class="btn btn-primary">Print</button>

@endsection