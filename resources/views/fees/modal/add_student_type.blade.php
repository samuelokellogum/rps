<!-- Modal -->
<div id="modal-add-studentType" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-student-type" action="#" method="post" class="row">
                    {{ csrf_field() }}
                    <input hidden :value="student_type.id"   name="id">
                    <div class="col-md-12">
                        <input name="name" :value="student_type.name"  placeholder="Day Students" class="form-control" type="text" required>
                    </div>

                   

                </form>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"  @click="addStudentType" class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>