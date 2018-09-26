@extends('layouts.app')
@section('content')

    <div class="row">

        <div class="col-md-12" style="margin-bottom: 20px">
            <button @click="addClazz" class="btn btn-primary">+ Add Class</button>
        </div>


        <div class="col-md-12">

            <table class="table table-striped table-bordered data-table">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Name</th>
                    <th>Streams</th>
                    <th style="width: 10%"></th>
                </tr>
                </thead>
                <tbody>

                {{-- test  --}}
                <?php $count = 1 ?>
                {{--@foreach($classes as $class)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $class->name }}</td>
                        <td>
                            <a style="font-weight: 600" href="#">1</a> <a @click="addClazzStream('{{ $class->id}}')" style="font-size: 12px; margin-left: 20px" href="#">Add Stream</a>
                        </td>
                        <td>

                            <button type="button" class="btn btn-default">
                                <span class="fa fa-pencil" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default">
                                <span class="fa fa-trash" aria-hidden="true"></span>
                            </button>

                        </td>
                    </tr>
                    @endforeach--}}

                <tr v-for="(clazz, index) in class_with_streams">
                    <td>@{{ index + 1 }}</td>
                    <td>@{{ clazz.name }}</td>
                    <td>
                        <a @click.prevent.stop="showStreams(index)" style="font-weight: 600" href="#">@{{  clazz.streams.length }}</a> <a @click.prevent.stop="addClazzStream(clazz.id)" style="font-size: 12px; margin-left: 20px" href="#">Add Stream</a>
                    </td>
                    <td>

                        <button @click=onClazzUpdate(clazz.id) type="button" class="btn btn-default">
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


    @include("clazz.modal.show_streams")
    @include("clazz.modal.add_clazz")
    @include("clazz.modal.add_clazz_stream")

@endsection
