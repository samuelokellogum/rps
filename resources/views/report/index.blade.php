@extends('layouts.app')
@section('content')

    <div class="row">
    

               <form id="form-gen-reports" method="get" action="{{ route("generateReports") }}">
           
                    <input hidden name="by" value="{{ $by }}">
                    <input hidden name="id" value="{{ $id }}">
                    <div class="col-md-3">
                        <h5>Select Term: </h5>
                        <select name="term" class="form-control" required>
                            @foreach($terms as $term)
                                <option {{ (isset($selected_term) && $selected_term == $term->id) ? 'selected' : '' }} value="{{ $term->id }}">{{ $term->name.' '.$term->year }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <h5>&nbsp;</h5>
                        <button @click.prevent.stop="generateReports" class="btn btn-primary">Generate Reports</button>
                    </div>

                 </form>


        <div class="col-md-12" style="margin-top: 30px;">
            <table class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th style="width: 10%">#</th>
                        <th>Name</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $key => $student)

                        <tr>
                            <td>
                                {{ ++$key }}
                                <img class="img-rounded" src="{{ ($student->photo != null) ? asset("storage/{$student->photo}") : asset("img/userplaceholder.png")}}" style="width: 50px; height: 50px; margin-left: 10px">
                            </td>
                            <td>{{ $student->name }}</td>
                            <td>
                                <a href="{{ route("studentReport", ["student_id" => $student->id]) }}" class="btn btn-primary">View Report Card</button>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

@endsection