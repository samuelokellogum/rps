@extends('layouts.app')
@section('content')

    <div class="row">

        <div class="col-md-12">
            <table class="table table-responsive data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>username</th>
                        <th>Roles</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i < 10; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>PAUUZ</td>
                            <td>pAUUZ</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

    </div>
    
@endsection