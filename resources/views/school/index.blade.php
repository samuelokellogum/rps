@extends('layouts.app')
@section('content')
        <div class="row" style="margin-bottom: 50px">
            <div class="col-md-8 col-md-offset-2">
                <div class="card-background has-padding">
                    <form method="post" id="form-school-data" action="{{ route("addSchoolData") }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>School name:</label>
                            <input type="text" class="form-control" name="name" value="{{ (isset($school)) ? $school->name :  '' }}" required>
                        </div>

                        <div class="form-group">
                            <label>School contact:</label>
                            <input type="text" class="form-control" name="contact" value="{{ (isset($school)) ? $school->contact :  '' }}" required>
                        </div>

                        <div class="form-group">
                            <label>School address:</label>
                            {{--  <input type="text" class="form-control" name="address" value={{ (isset($school)) ? $school->address :  '' }}> --}}
                            <textarea class="form-control" rows="3" id="comment" name="address" required>{{ (isset($school)) ? $school->address :  '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>School motto</label>
                            <input type="text" class="form-control" name="motto" value="{{ (isset($school)) ? $school->motto :  '' }}" required>
                        </div>

                        <div class="form-group">
                            <label>School website</label>
                            <input type="text" class="form-control" name="website" value="{{ (isset($school)) ? $school->website :  '' }}" required>
                        </div>


                        {{--image prest--}}
                        @if(isset($school) && $school->badge != null)
                            <input hidden id="img-preset" value="{{ asset('storage/'.$school->badge) }}">
                        @endif

                        <div class="form-group">
                            <div style="text-align: center">
                                <h4 style="margin-top: 10px">School badge</h4>
                                    <div  class="upload-btn-wrapper">
                                        <div class="image-preview">
                                            <img v-show="imageShow" class="img-thumbnail" style="width: 180px; height: 180px;" :src="imageSrc">
                                            <h6 v-show="!imageShow">Click to upload</h6>
                                            <img v-show="!imageShow" src="{{ asset("img/icons/camera.png") }}" style="width: 50px; height: 50px;">
                                        </div>
                                        <input type="file"  @change="onFileChange" id="usr_image" name="usr_image" />
                                    </div>
                                    <div v-show="imageShow">
                                        <div class="text-center" style="margin-top: 5px;">
                                            <button @click.prevent.stop="removeImage" class="btn btn-danger">Remove Image</button>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <h6 class="text-center">
                            <button type="submit" style="width: 200px; height: 40px" class="btn btn-primary">Submit</button>
                        </h6>

                    </form>
                </div>
            </div>
        </div>
@endsection
