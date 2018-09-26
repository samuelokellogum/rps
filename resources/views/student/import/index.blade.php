@extends("layouts.app")
@section("content")

    <div class="row">
        <div class="col-md-4">

            <form class="row" method="post" action="{{ route("importStudentFile") }}" enctype="multipart/form-data">

                {{ csrf_field() }}
                <?php $now = \Carbon\Carbon::now() ?>
                <div style="margin-bottom: 20px" class="col-md-12">
                    <select @change="onSelectClassChange" name="clazz_id" class="form-control" required>
                         <option value="" selected disabled>--select class --</option>
                        <option v-for="(clazz, index) in student_classes" :value="clazz.id+'-'+index+'-'+clazz.name">@{{ clazz.name }}</option>
                    </select>
                </div>

                <div v-if="student_class_streams.length > 0" style="margin-bottom: 20px" class="col-md-12">
                    <select @change="onSelectStreamChange" name="clazz_stream" class="form-control" required>
                        <option value="" selected disabled>-- select stream --</option>
                        <option v-for="(stream, index) in student_class_streams"  :value="stream.id" >@{{ stream.name }}</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <div  class="file-picker">
                        <input type="file"  name="file" />
                        <div class="file-icon">
                            <img src="{{ asset("img/icons/upload.png") }}" style="width: 50px; height: 50px">
                            <h6>Choose a file</h6>
                        </div>
                        <div class="file-label">
                            <span class="file-name"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Import</button>
                </div>

            </form>


        </div>
    </div>


    @endsection