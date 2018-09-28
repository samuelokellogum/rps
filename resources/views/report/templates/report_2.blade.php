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
                        <img src="{{ asset('img/member.jpg') }}" style="width: 100px; height: 120px">
                    </td>
                     <td>
                        <h6>Name: Sayrunjah Pauuz</h6>
                        <h6>Class: Form 1 North</h6>
                     </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Subject</td>
                        <td colspan="3">Marks</td>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 25; $i++)
                        <tr>
                            <td>Math</td>
                            <td>{{ mt_rand(60,90) }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

</div>

<button @click="printTest('printMe')" class="btn btn-primary">Print</button>

@endsection