<!-- Modal -->
<div id="modal-update-mark" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button  type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-update-mark" action="#" method="post" class="row">
                    {{ csrf_field() }}
                    <input hidden :value="mark_data.id"   name="id">
                    <input hidden :value="mark_data.student"   name="student">
                    <input hidden :value="term_update"   name="term">
                    <input hidden :value="exam_update"   name="exam">
                    <div class="col-md-12">
                        <input name="mark" :value="mark_data.mark"  class="form-control" type="text">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click="updateMark" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>