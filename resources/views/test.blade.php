@extends("layouts.app")
@section("content")

    @{{ test_data }}

    <div v-for="(clazz , index) in test_data.classes_with_data">
        <h6>@{{ clazz.name }}</h6>
        <hr>
        <div v-if="clazz.streams.length > 0">
            <div v-for="(stream, index1) in clazz.streams">
                <h6>@{{ stream.name }}</h6>
                <hr>
                <div v-if="stream.students.length > 0">
                    <div v-for="(student, index2) in stream.students">
                        <h6>@{{ student.name }} @{{ student.reg_number }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>No Streams</div>
    </div>

    @endsection