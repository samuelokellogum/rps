<!-- Modal -->
<div id="modal-add-subject-pats" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <form id="form-add-subject-pat" action="#" method="post" class="row">
                    {{ csrf_field() }}
                    <input hidden :value="subject_pat_data.id"  name="id">
                    <input hidden :value="subject_pat_data.subject_id"  name="subject_id">
                    <div class="col-md-12">
                        <input name="name" :value="subject_pat_data.name"  placeholder="Name e.g PAPER 1" class="form-control" type="text" required>
                    </div>

                    <div class="col-md-12">
                        <input name="short_name" :value="subject_pat_data.short_name"  placeholder="Short Name e.g P1" class="form-control" type="text" required>
                    </div>

                        <div class="col-md-12">
                            <button @click="clearSubForm" style="margin-left: 20px" type="button" class="btn btn-danger pull-right">Clear</button>
                            <button @click="addSubjectPat" :disabled="is_subject_btn" type="button" class="btn btn-primary pull-right">Submit</button>
                        </div>

                </form>
                </div>

                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Short name</th>
                            <th style="width: 20%;"></th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr v-for="(sub_pat, index) in subject_pats">
                            <td>@{{ sub_pat.name }}</td>
                            <td>@{{ sub_pat.short_name }}</td>

                            <td>
                                <button @click="onSubjectPatUpdate(sub_pat.id)"  type="button" class="btn btn-default">
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