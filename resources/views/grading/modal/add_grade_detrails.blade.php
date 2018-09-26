<!-- Modal -->
<div id="modal-add-grade-details" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body row">

                <div class="col-md-12">
                    <form id="form-add-grade-details" action="#" method="post" class="row">
                        {{ csrf_field() }}

                        <input hidden :value="grade_details_data.id"   name="id">
                        <input hidden :value="grade_details_data.grading_id"   name="grading_id">

                        <div>
                            <div class="col-md-5">
                                <input name="mark_start" :value="grade_details_data.mark_start"  placeholder="Mark start" class="form-control"  type="number" required>
                            </div>
                            <div class="col-md-2">
                                <div class="rps-separator"></div>
                            </div>
                            <div class="col-md-5">
                                <input name="mark_end" :value="grade_details_data.mark_end"  placeholder="Mark end" class="form-control"  type="number" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <input name="symbol" :value="grade_details_data.symbol"   placeholder="Symbol e.g A, B, D1, D2, F .... " class="form-control"  type="text" required>
                        </div>
                        <div class="col-md-12">
                            <input name="consist_of" :value="grade_details_data.consist_of"  placeholder="Points e.g 1,2,5,6...." class="form-control"  type="number" required>
                        </div>


                        <div class="col-md-12">
                            <button @click="clearForm" style="margin-left: 20px" type="button" class="btn btn-danger pull-right">Clear</button>
                            <button @click="addGradeDetails" :disabled="is_grade_btn" type="button" class="btn btn-primary pull-right">Submit</button>
                        </div>

                    </form>
                </div>

                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>start</th>
                                <th>end</th>
                                <th>Symbol</th>
                                <th>Consist of</th>
                                <th style="width: 20%;"></th>
                            </tr>
                        </thead>

                        <tbody>

                        <tr v-for="(detail, index) in grade_details">
                            <td>@{{ detail.mark_start }}</td>
                            <td>@{{ detail.mark_end }}</td>
                            <td>@{{ detail.symbol }}</td>
                            <td>@{{ detail.consist_of }}</td>
                            <td>
                                <button @click="onGradeDetailUpdate(detail.id)" type="button" class="btn btn-default">
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
            {{--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-primary" >Submit</button>
            </div>--}}
        </div>

    </div>
</div>