@extends('layouts.app')
@section('content')

    <div class="row">

        <div class="col-md-12" style="margin-bottom: 20px">
            <button @click="addGrade" class="btn btn-primary">+ Add Grading</button>
        </div>


        <div class="col-md-12">

            <table class="table table-striped table-bordered data-table">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th style="width: 10%"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(grade, index) in grade_with_details">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ grade.name }}</td>
                    <td>
                        <a @click.prevent.stop="showAddGradeDetails(grade.id, index)" style="font-size: 12px; margin-left: 20px" href="#">Grade Details</a>
                    </td>
                    <td>
                        <button @click="onGradingUpdate(grade.id)" type="button" class="btn btn-default">
                            <span class="fa fa-pencil" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-default">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

    @include("grading.modal.add_grading")
    @include("grading.modal.add_grade_detrails")
@endsection
