<!-- Modal -->
<div id="modal-update-student" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-update-temp" action="{{ route("updateTempData") }}" method="post" class="row" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input hidden :value="student_temp_data.id"  name="id">

                    <div class="col-md-12">
                        <div class="form-group">
                            <div style="text-align: center">
                                <h4 style="margin-top: 10px">Student Image</h4>
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
                    </div>

                    <div class="col-md-12">
                        <input name="name" :value="student_temp_data.name"   placeholder="Name" class="form-control" type="text" required>
                    </div>

                    <div class="col-md-12">
                        <h6 style="font-size: 18px">Gender: </h6>
                        <div class="form-check">
                            <label class="cr-label">
                                <input type="radio" name="gender" :checked="student_temp_data.gender =='male' || student_temp_data.gender == null" value="male"> <span class="label-text">Male</span>
                            </label>

                            <label class="cr-label">
                                <input type="radio" name="gender" :checked="student_temp_data.gender =='female'" value="female" required> <span class="label-text">Female</span>
                            </label>

                        </div>
                        <div class="form-check">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <input name="dob" :readonly="true" :value="student_temp_data.dob"  placeholder="Date of Birth" class="form-control datepicker" type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="guardian_name" :value="student_temp_data.guardian_name"  placeholder="Guardian name" class="form-control"  type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="guardian_contact" :value="student_temp_data.guardian_contact"  placeholder="Guardian contact" class="form-control"  type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="year_of_admin" :readonly="true" :value="student_temp_data.year_of_admin"  placeholder="Year of admission" class="form-control datepickerYear" type="text" required>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" @click="submitUpdateForm" class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>