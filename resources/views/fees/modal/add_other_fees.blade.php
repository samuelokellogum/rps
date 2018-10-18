<!-- Modal -->
<div id="modal-other-fees" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-other-fees" action="#" method="post" class="row">
                    {{ csrf_field() }}
                    <input hidden :value="other_fees.id"   name="id">

                    <div class="col-md-12">
                        <input name="name" :value="other_fees.name"  placeholder="E.g Sports fee" class="form-control" type="text" required>
                    </div>
                    <div class="col-md-12">
                        <input name="amount"  :value="other_fees.amount"  placeholder="Amount in money" class="form-control currency" type="text" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" @click="addOtherFees" class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>