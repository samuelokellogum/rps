<!-- Modal -->
<div id="modal-add-class-suppat" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    
                
                    <table class="table table-bordered">
                        <tbody>
                              
                                <tr   v-for="(pat , index) in rc_subject.particulars">
                                    <td>@{{ pat.name }}</td>
                                    <td>@{{ pat.short_name }}</td>
                                    <td>
                                        <label class="cr-label">
                                            <input class="pat_check" type="checkbox" :checked="rc_subject_pats.includes(pat.id)" :value="pat.id"> <span class="label-text"></span>
                                        </label>
                                    </td>
                                </tr>
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click="submitClassPatForm" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>