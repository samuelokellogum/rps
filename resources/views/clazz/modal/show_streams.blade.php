<!-- Modal -->
<div id="show-streams" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Streams</h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Short Name</th>
                            <th style="width: 20%"></th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="(stream, index) in class_streams">
                            <td>@{{ stream.name }}</td>
                            <td>@{{  stream.short_name }}</td>
                            <td>
                                <button @click="onClazzStreamUpdate(stream.id)" type="button" class="btn btn-default">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-default">
                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>