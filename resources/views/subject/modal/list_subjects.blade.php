<!-- Modal -->
<div id="modal-list-subjects" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body row">

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

                        <tr v-for="(subject, index) in subjects_list">
                            <td>@{{ subject.name }}</td>
                            <td>@{{ subject.short_name }}</td>

                            <td>
                                <div class="form-check">
                                    <label class="cr-label">
                                        <input type="checkbox" class="subject_check" :checked="class_subjects_array.includes(subject.id)" :value="subject.id" name="check"> <span class="label-text"></span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>

                <div class="col-md-12">
                    <button @click="confirmSubjects" class="btn btn-primary btn-sm pull-right">Confirm</button>
                </div>

            </div>
            {{--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-primary" >Submit</button>
            </div>--}}
        </div>

    </div>
</div>