@extends('layouts.app')
@section('content')

    <div class="row">

        <div class="col-md-12" style="margin-bottom: 20px">
            <button @click="showAddTerm" class="btn btn-primary">+ Add New Term</button>
        </div>


        <div class="col-md-12">

            <table class="table table-striped table-bordered data-table">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Name</th>
                    <th>Term Start</th>
                    <th>Term End</th>
                    <th>YEAR</th>
                    <th style="width: 10%"></th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="(term ,index) in all_terms">
                    <td>@{{  index + 1 }}</td>
                    <td>@{{ term.name }}</td>
                    <td><span>@{{ term.start | moment("ddd, DD/MMM/YYYY") }}</span></td>
                    <td><span>@{{ term.end | moment("ddd, DD/MMM/YYYY") }}</span></td>
                    <td>@{{ term.year }} <span  style="margin-left: 20px" :class="{ is_active: term.status == 'active', is_inactive: term.status == 'inactive' }"> @{{ term.status | uppercase }} </span></td>
                    <td>

                        <button @click="onTermUpdate(term.id)" type="button" class="btn btn-default">
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


   @include("term.modal.add_term")
@endsection
