<!-- Modal -->
<div id="modal-add-term" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-add-term" action="#" method="post" class="row">
                    {{ csrf_field() }}
                    <input hidden :value="term_data.id"  name="id">
                    <div class="col-md-12">
                        <input name="name" :value="term_data.name"   placeholder="Term name e.g Term iii " class="form-control" type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="year" :value="term_data.year"  placeholder="Year" class="form-control datepickerYear" type="text" readonly required>
                    </div>

                    <div>
                        <div class="col-md-5">
                            <input name="start" :value="term_data.start"  placeholder="Term start" class="form-control datepicker"  type="text" readonly required>
                        </div>
                        <div class="col-md-2">
                            <div class="rps-separator"></div>
                        </div>
                        <div class="col-md-5">
                            <input name="end"   :value="term_data.end" placeholder="Term end" class="form-control datepicker"  type="text" readonly required>
                        </div>
                    </div>



                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click="addTerm" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>