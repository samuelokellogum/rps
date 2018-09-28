@extends('layouts.app')
@section('content')

<div id="all_printable">
@for($k= 1; $k <= 5; $k++)

    <div class="row printThis">
        <div class="col-md-12">
            <h4 style="text=align: center;">ST PAUL HIGH SCHOOL</h4>
            <h5 style="text-align:center;">Student name: Student-{{ $k }}</h5>
        </div>
    </div>

    <div class="row">
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

<div class="page-break"></div>
@endfor
</div>

    <div>
        <button @click="printTest('all_printable')" class="btn btn-danger">Print report</button>
    </div>

 
    
@endsection