<!-- Modal -->
<div id="modal-add-clazz" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-add-class" action="#" method="post" class="row">
                    {{ csrf_field() }}
                    <input hidden :value="class_data.id"   name="id">
                    <div class="col-md-12">
                        <input name="name" :value="class_data.name"   placeholder="Name e.g Form 1, Senior 1.." class="form-control" type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="short_name" :value="class_data.short_name"   placeholder="Short Name e.g F1, S1, ..." class="form-control" type="text" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click="addClassData" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>