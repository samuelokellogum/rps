@extends("layouts.app")
@section("content")

    <div class="row">

        <div class="col-md-4">
            <h4>@{{  class_name }}</h4>
        </div>

        <div class="col-md-2">
            <form action="#" method="get">
                <select @change="onSelectClassChange" name="clazz" class="form-control" required>
                    <option value="" selected disabled>--select class --</option>
                    <option v-for="(clazz, index) in student_classes" :value="clazz.id+'-'+index+'-'+clazz.name">@{{ clazz.name }}</option>
                </select>
            </form>
        </div>

        <div v-if="student_class_streams.length > 0"  class="col-md-2">
            <form action="#" method="get">
                <select @change="onSelectStreamChange" name="stream" class="form-control" required>
                    <option value="" selected disabled>-- select stream --</option>
                    <option v-for="(stream, index) in student_class_streams"  :value="stream.id" >@{{ stream.name }}</option>
                </select>
            </form>
        </div>

        <div class="col-md-2">
            <form action="#" method="get">
                <?php  $now = \Carbon\Carbon::now()?>
                <select @change="onClassYearChange" class="form-control  custom-select" title="Year is required" name="year" required>
                    <option disabled selected>Year</option>
                    @foreach(range( $now->year, $now->year-15) as $year)
                        <option value="{{$year}}">{{$year}}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="col-md-2">
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

                <tr v-for="(student, index) in student_list">
                    <td>
                        @{{ index + 1 }}
                        <img v-if="student.photo != null" class="img-rounded" :src="storage_path+student.photo" style="width: 50px; height: 50px; margin-left: 10px">
                        <img v-else class="img-rounded" src="{{asset("img/userplaceholder.png")}}" style="width: 50px; height: 50px; margin-left: 10px">
                    </td>
                    <td>
                        <h4>@{{ student.name }}</h4>
                        <h6>@{{ student.reg_number }}</h6>
                    </td>
                    <td>
                        <h4>@{{ student.guardian_name }}</h4>
                        <h6>@{{ student.guardian_contact }}</h6>
                    </td>

                    <td>


                        <button @click="onStudentUpdate(student.id)" type="button" class="btn btn-default">
                            <span class="fa fa-pencil" aria-hidden="true"></span>
                        </button>
                        <button @click="deleteStudent(student.id)" type="button" class="btn btn-default">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>

                    </td>

                </tr>

                </tbody>
            </table>
        </div>

    </div>

    @include("student.modal.add_student")
@endsection