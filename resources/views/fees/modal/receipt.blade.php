<!-- Modal -->
<div id="modal-receipt" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <?php $school = \App\School::find(1); ?>
            <div class="modal-body">
                <div class="row receipt">
                    <div class="col-md-12">
                        <h4 style="text-align: center">SCHOOL FEES RECEIPT</h4>
                        <h4 style="text-align: center">{{ $school->name }}</h4>
                        <h4 style="text-align: center">{{  $school->address }}</h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Recieved From</td>
                                    <td class="line"><div></div></td>
                                </tr>
                                <tr>
                                    <td>Sum of:</td>
                                    <td class="line"><div></div></td>
                                </tr>
                                <tr>
                                    <td>Payment for: </td>
                                    <td class="line"><div></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
           
        </div>

    </div>
</div>