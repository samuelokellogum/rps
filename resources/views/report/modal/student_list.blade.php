<!-- Modal -->
<div id="modal-students" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Student List</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                
                    <div class="col-md-12">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                </tr>
                            <thead>
                                <tbody>
                                    <tr v-for="(item, index) in  promtion_data">
                                        <td>@{{ item.name }}</td>
                                        <td>@{{ item.position }}</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
          
            </div>
        </div>

    </div>
</div>