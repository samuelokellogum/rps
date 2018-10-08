@extends('layouts.app')
@section('content')

    <div class="row">

        <div class="col-md-12" style="margin-bottom: 20px">
            <button @click="showAddSubject" class="btn btn-primary">+ Add Subject</button>
        </div>


        <div class="col-md-12">

            <table class="table table-striped table-bordered data-table">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Name</th>
                    <th>Particulars</th>
                    <th style="width: 10%"></th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="(subject , index) in subjects_with_pats">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ subject.name }}</td>
                    <td><a @click.prevent.stop="showAddSubjectPat(subject.id, index)" style="font-size: 12px; margin-left: 20px" href="#">@{{ subject.particulars.length }}  Add particular</a></td>
                    <td>

                        <button @click="onSubjectUpdate(subject.id)" type="button" class="btn btn-default">
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


    @include("subject.modal.add_subject")
    @include("subject.modal.add_subject_particular")
@endsection
