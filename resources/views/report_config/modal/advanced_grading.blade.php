<!-- Modal -->
<div id="modal-advanced-grading" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 30%">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body row">
                <div class="col-md-12">
                    <form id="form-advanced-config" action="#" method="post">
                    {{ csrf_field() }}
                    <input hidden name="clazz_id" value={{ $clazz->id }}>
                    <input hidden name="id" :value="rc_this_adva_grade.id">
                    <div class="col-md-12">
                        <input name="symbol" :value="rc_this_adva_grade.symbol"  placeholder="Symbol e.g A, B, C" class="form-control" type="text" required>
                    </div>

                      <div class="col-md-12">
                        <input name="consist_of" :value="rc_this_adva_grade.consist_of"   placeholder="consist of e.g 6, 5, 4, 4....." class="form-control" type="text" required>
                    </div>

                     <div>
                            <div class="col-md-5">
                                <input name="range_1"  :value="rc_this_adva_grade.range_1" placeholder="Start" class="form-control"  required>
                            </div>
                            <div class="col-md-2">
                                <div class="rps-separator"></div>
                            </div>
                            <div class="col-md-5">
                                <input name="range_2"  :value="rc_this_adva_grade.range_2" placeholder="Stop" class="form-control"  required>
                            </div>
                        </div>

        

                </form>
                </div>

                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 20%">Symbol</th>
                                <th style="width: 50%">Range</th>
                                <th style="width: 30%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(grade, index) in rc_adva_grades">
                                <td>@{{ grade.symbol }}</td>
                                <td>@{{ grade.range_1 }} -  @{{ grade.range_2 }}</td>
                                 <td>
                                <button @click="editAdGrade(index)" type="button" class="btn btn-default">
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
                <button type="button" @click="rc_this_adva_grade = {}" class="btn btn-danger">Clear</button>
                <button @click="addAdvancedConfig" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>