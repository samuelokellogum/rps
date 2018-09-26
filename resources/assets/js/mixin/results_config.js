const resultConfig = {

    mounted() {},
    data() {
        return {
            rc_subject_data: {},
            rc_subject: {},
            rc_class: {},
            rc_subject_pats: []
        }
    },
    methods: {
        showAddClassSubPat(clazz_id, subject_id) {
            var app = this
            $.ajax({
                url: base_url + "/getSubjectPatsForClass",
                data: {
                    clazz_id: clazz_id,
                    subject_id: subject_id
                },
                success(data) {
                    app.rc_subject_data = data;
                    app.rc_subject = data.subject
                    app.rc_class = data.class
                    app.rc_subject_pats = data.pats
                    $("#modal-add-class-suppat").modal("show")
                }
            })
        },
        submitClassPatForm(){
            var app = this
             var subjects = [];
             $(".pat_check").each(function (index, item) {
                 if ($(this).is(':checked')) {
                     subjects.push($(this).val())
                 }
             })


            $.ajax({
                url: base_url + "/addPartsToClass",
                data: {
                    pats: subjects,
                    clazz_id: app.rc_class.id,
                    subject_id: app.rc_subject.id
                },
                success(data){
                    window.location.reload(true)
                }
            })
        },

        showAdvancedGrading(){
            $("#modal-advanced-grading").modal('show')
        }
    }

}

export default resultConfig