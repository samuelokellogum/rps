<!-- Modal -->
<div id="modal-add-clazz-stream" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-add-class-stream" action="#" method="post" class="row">
                    {{ csrf_field() }}
                    <input hidden :value="class_stream_data.clazz_id"  name="clazz_id">
                    <input hidden  :value="class_stream_data.id" name="id">
                    <div class="col-md-12">
                        <input name="name" :value="class_stream_data.name"  placeholder="Name e.g North" class="form-control" type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="short_name" :value="class_stream_data.short_name"   placeholder="Short Name e.g N" class="form-control" type="text" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click="addClassStream" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>