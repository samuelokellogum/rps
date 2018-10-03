@extends("layouts.app")
@section("content")

    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Class</th>
                        <th>Subjects</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(clazz, index) in class_with_subjects">
                        <td>@{{ index+1 }}</td>
                        <td>@{{ clazz.name }}</td>
                        <td v-if="clazz.streams.length > 0">
                            <div v-for="(stream, index2) in  clazz.streams" style="margin-bottom: 10px">
                                @{{ stream.name }} @{{ stream.subjects.length }} <a style="margin-left: 25px" href="#" @click.prevent.stop="showSubjectList(clazz.id, index, stream.id, index2)">Add/Remove Subject</a>
                            </div>
                        </td>
                        <td v-else>@{{ clazz.subjects.length }} <a style="margin-left: 25px" href="#" @click.prevent.stop="showSubjectList(clazz.id, index)">Add/Remove Subject</a></td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>

    @include("subject.modal.list_subjects")
    @endsection