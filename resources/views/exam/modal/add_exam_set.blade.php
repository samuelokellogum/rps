<!-- Modal -->
<div id="modal-add-examset" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-exam-set" action="{{ route("addEXamSet") }}" method="post" class="row">
                    {{ csrf_field() }}
                    <input hidden :value="exam_set.id"   name="id">
                    <div class="col-md-12">
                        <input name="name" :value="exam_set.name"  placeholder="Name e.g Beginning of term" class="form-control" type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="short_name" :value="exam_set.short_name"  placeholder="Short Name e.g BOT" class="form-control" type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="total_mark" :value="exam_set.total_mark"  placeholder="0 - 100" class="form-control" type="text" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click="submitExamSet" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>