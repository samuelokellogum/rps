@extends("layouts.app")
@section("content")

    <div class="row">
        <div class="col-md-12">
            <a href="{{ route("confirmStudentImport", ["id" => $file->id ]) }}" class="btn btn-primary pull-right">Confirm</a>
        </div>


        <div style="margin-top: 30px" class="col-md-12">
            <table class="table table-striped data-table">
                <thead>
                <tr>
                    <th style="width: 10%"></th>
                    <th>Details</th>
                    <th>Guardian Details</th>
                    <th>Errors</th>
                    <th style="width: 5%"></th>
                </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach($temp_data as $data)
                        <tr style="{{ ($data->status == "rejected") ? 'background:red; color: white' : '' }}">
                            <td>
                                {{ $count++ }}
                                <img  class="img-rounded" src="{{ ($data->photo == null) ? asset("img/userplaceholder.png") : asset("storage/{$data->photo}") }}" style="width: 50px; height: 50px; margin-left: 10px">

                            </td>
                            <td>
                                <h6>{{ $data->name }}</h6>
                                <h6>DOB: {{ $data->dob }}</h6>
                            </td>
                            <td>
                                <h6>{{ $data->guardian_name }}</h6>
                                <h6>{{ $data->guardian_contact }}</h6>
                            </td>
                            <td>
                                <h6>{{ $data->errors }}</h6>
                            </td>
                            <td>
                                <button @click="onUpdateTempData({{$data->id}})" type="button" class="btn btn-default">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>


    @include("student.import.modal.update_data")
    @endsection