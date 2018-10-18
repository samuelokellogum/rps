<!-- Modal -->
<div id="modal-students-reports" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Student Reports</h4>
            </div>
            <div class="modal-body">
                <div id="student-reports">
                    <div  v-if="Object.keys(all_reports_data).length > 0 " v-for="(item, index) in all_reports_data.student_data">
                            <report class="is-page" :term="all_reports_data.term" :clazz="all_reports_data.clazz" :school="all_reports_data.school" :student="item.student" :report="item.report"></report>
                            <div class="page-break"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>