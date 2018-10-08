@extends('layouts.app')
@section('content')

<div id="printMe" class="row" style="padding: 25px 20px 10px 20px;">

    <div class="col-sm-4" style="width: auto">
        <img src="{{ asset('img/school_badge.jpg') }}" style="width: 80px; height: 90px">
    </div>
    
    <div class="col-sm-8">
        <span style="font-size: 20px">{{ strtoupper($school->name) }}</span><br>
        <span style="font-size: 15px">Contact: {{ $school->contact }}</span><br>
        <span style="font-size: 15px">Address: {{ $school->address }}</span><br>
    </div>


    <div class="col-sm-12">
        <table class="table student-data">
            <thead>
                <tr></tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="the-label">Name: </span> {{ $student->name }}</td>
                    <td><span class="the-label">Class: </span> {{ $student->clazz()->name }}</td>
                    <td><span class="the-label">Year: </span> {{ $term->year }}</td>
                </tr>
                <tr>
                    <td><span class="the-label">Aggregate: </span>{{  $results->full_report->all_avg->points }}</td>
                    <td><span class="the-label">Position: </span>{{  $results->full_report->position }}</td>
                    <td><span class="the-label">Term: </span> {{  $term->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-12">
            <table class="table table-striped table-bordered table-pretty">
                <thead>
                    <tr>
                        <?php $footspan = 2; ?>
                        <th style="width: 20%"></th>
                        @foreach (collect($results->full_report->results)->first()->result as $key => $result)
                           <th style="width: 5%">{{ $key }}</th>
                           <?php $footspan++; ?>
                        @endforeach
                        <th style="min-width: 10%">Final / Remarks</th>
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
                                            {{ $fv->mark }} |  {{ $fv->g_symbol }}                                     
                                        </div>    
                                        @endforeach
                                    </div>
                                </td>
                            @endforeach

                            <td class="pretty">
                                <div class="row">
                                    {{--  <div class="col-sm-4">
                                        {{ $result->final_result->all_average->total }}
                                    </div>  --}}
                                <div class="col-sm-6">
                                    {{ $result->final_result->all_average->symbol }}
                                </div>
                                <div class="col-sm-6">
                                    {{ $result->final_result->all_average->comment }}
                                </div>
                            </div>
                                
                            </td>

                        <tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td style="font-size: 20px" align="right" colspan="{{ $footspan }}">
                            <span style="font-weight: 600">Total:</span> 
                            {{$results->full_report->all_avg->total}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>


        <table class="table noborder" style="margin-top: 20px">
            <tbody>
                <tr>
                    <td class="title">Teacher&rsquo;s comment:</td>
                    <td style="width: 85%"><span class="raw-line"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="raw-line"></span></td>
                </tr>

                <tr>
                    <td class="title">Teacher&rsquo;s signature: </td>
                    <td><span class="raw-line" style="width: 30%"></span</td>
                </tr>

                 <tr>
                    <td class="title">HeadMaster&rsquo;s comment:</td>
                    <td style="width: 85%"><span class="raw-line"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="raw-line"></span></td>
                </tr>

                 <tr>
                    <td class="title">HeadMaster&rsquo;s signature: </td>
                    <td><span class="raw-line" style="width: 30%"></span</td>
                </tr>

            </tbody>
        </table>


        <table class="table noborder">
            <tbody>
                <tr>
                    <td>Term closes on</td>
                    <td style="width: 38%"><span class="raw-line"></span></td>
                    <td>Next term begins</td>
                    <td style="width: 38%"><span class="raw-line"></span></td>
                </tr>
            </tbody>
        </table>

</div>

<button @click="printTest('printMe')" class="btn btn-primary">Print</button>

@endsection