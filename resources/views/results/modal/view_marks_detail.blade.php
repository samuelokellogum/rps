<!-- Modal -->
<div id="modal-student-marks" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button @click="onResultDissmis" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 2%">#</th>
                                    <th>Name</th>
                                    <th style="width: 60%">Parts</th>
                                </tr>
                            </thead>

                            <tbody>

                            <tr v-for="(result, index) in results_marks">
                                <td>@{{ index+1 }}</td>
                                <td v-if="result.subject">@{{  result.subject.name }}</td>
                                <td style="padding: 5px 0px">
                                    <template v-if="result.marks" v-for="(mark, index) in result.marks">
                                        <div v-if="index != 0" class="td-separator"></div>
                                        <div style="padding: 10px">
                                            <span v-if="mark.mark != null">@{{ mark.pat }} <span v-if="mark.pat != ''">:</span> <a @click.prevent.stop="showMarkUpdate(mark.mark_id, mark.mark, result.student.id)" href="#">@{{ mark.mark }} %</a></span>
                                            <span v-else-if="mark.mark_id != null && mark.mark == null">@{{ mark.pat }}:  <a @click.prevent.stop="showMarkUpdate(mark.mark_id, mark.mark, result.student.id)" href="#"> Missing Marks</a></span>
                                            <span v-else>@{{ mark.pat }} </span>
                                        </div>

                                    </template>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            {{--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-primary" >Submit</button>
            </div>--}}
        </div>

    </div>
</div>