@extends("layouts.app")
@section("content")

    <div class="row">

        <div class="col-md-4">
            <h4>{{ $class->name }} {{ isset($stream) ? $stream->name : '' }}</h4>
        </div>


        <div class="col-md-8">
            <button @click="showAddStudent" class="btn btn-primary pull-right">+ Add Student</button>
        </div>

        <div style="margin-top: 20px; margin-bottom: 20px" class="col-md-12">
            <hr>
        </div>


        <div class="col-md-12">
            <table class="table table-striped table-bordered data-table">
                <thead>
                <tr>
                    <th style="width: 10%">#</th>
                    <th>Details</th>
                    <th>Guardian</th>
                    <th style="width: 10%"></th>
                </tr>
                </thead>
                <tbody>

                <?php $count = 1 ?>
                @foreach($students as $student)
                    <tr>
                        <td>
                            {{ $count++ }}
                            <img  class="img-rounded" src="{{ ($student->photo == null) ? asset("img/userplaceholder.png") : asset("storage/{$student->photo}") }}" style="width: 50px; height: 50px; margin-left: 10px">
                        </td>
                        <td>
                            <h4>{{ $student->name }}</h4>
                            <h6>{{ $student->reg_number }}</h6>
                        </td>

                        <td>
                            <h4>{{ $student->guardian_name }}</h4>
                            <h6>{{ $student->guardian_contact }}</h6>
                        </td>

                        <td>


                            <button @click="onStudentUpdate({{ $student->id }})" type="button" class="btn btn-default">
                                <span class="fa fa-pencil" aria-hidden="true"></span>
                            </button>
                            <button @click="deleteStudent({{ $student->id }})" type="button" class="btn btn-default">
                                <span class="fa fa-trash" aria-hidden="true"></span>
                            </button>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @include("student.modal.add_student")
@endsection