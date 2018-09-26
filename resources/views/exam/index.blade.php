@extends("layouts.app")
@section("content")



    <div class="row">

        <div class="col-md-12">
            <button @click="showAddExamSet" class="btn btn-primary">+ Exam Set</button>
        </div>

        <div style="margin-top: 20px" class="col-md-12">
            <table class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th style="width: 10%">#</th>
                        <th>Name</th>
                        <th>Short Name</th>
                        <th style="width: 10%"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $count = 1 ?>
                    @foreach($examSets as $examSet)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $examSet->name }}</td>
                            <td>{{ $examSet->short_name }}</td>
                            <td>
                                <button @click="onExamSetUpdate({{$examSet->id}})" type="button" class="btn btn-default">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                </tbody>

            </table>
        </div>

    </div>

    @include("exam.modal.add_exam_set")
    @endsection