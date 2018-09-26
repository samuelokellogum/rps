<!-- Modal -->
<div id="modal-all-marks-preview" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Marks : @{{ marks_subject_data.name }} @{{ selected_exam.short_name }} @{{ selected_term.name }}</h4>
            </div>
            <div class="modal-body">



                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10%"></th>
                                    <th>Details</th>
                                    <th>Marks</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in all_marks_preview">
                                    <td>
                                        <img v-if="item.photo != null" class="img-rounded" :src="storage_path+item.photo" style="width: 50px; height: 50px; margin-left: 10px">
                                        <img v-else class="img-rounded" src="{{asset("img/userplaceholder.png")}}" style="width: 50px; height: 50px; margin-left: 10px">
                                    </td>
                                    <td>
                                        <h6>@{{ item.name }}</h6>
                                        <h6>@{{ item.reg_number }}</h6>
                                    </td>
                                    <td>
                                        <h6 v-for="(paper , index) in item.marks" :class="{'missing_marks' : paper.mark == ''}">@{{ paper.paper }} :     <span v-if="paper.mark != ''" style="font-weight: 600">@{{ paper.mark }}%</span></h6>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click="sendMarks(all_marks_preview)" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>