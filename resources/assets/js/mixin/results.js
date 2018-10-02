const results = {

    mounted(){},
    data(){
        return{
            results_marks:{},
            mark_data: {},
            is_mark_updated: false
        }
    },
    methods:{
         showStudentMarks(id){
             var app = this
             $.ajax({
                 url: base_url+"/onMarksUpdate",
                 data:{
                     id: id
                 },
                 success(data){
                    app.results_marks = data
                     $("#modal-student-marks").modal("show")
                 }
             })

         },
        showMarkUpdate(id, mark, student){
             var app = this
            app.mark_data = {}
            app.mark_data.id = id
            app.mark_data.mark = mark
            app.mark_data.student = student
            $("#modal-update-mark").modal("show")
        },
        updateMark(){
            var app = this

            if($("#form-update-mark").valid()){
                $.ajax({
                    url: base_url+"/updateMark",
                    type: "post",
                    data:$("#form-update-mark").serialize(),
                    success(data){
                        app.results_marks = data
                        app.is_mark_updated = true
                        $("#modal-update-mark").modal("hide")
                        app.$iziToast.success({
                            position: 'topCenter',
                            message: "Marks  updated",
                        })
                    }
                })
            }

        },
        onResultDissmis(){
            if(this.is_mark_updated){
                window.location.reload(true)
            }

        },
        showPrintable(){
            $("#modal-printable-results").modal("show")
        },

        generateReports(){
            $.ajax({
                url: base_url +"/generateReports",
                data: $("#form-gen-reports").serialize(),
                success(data){
                    console.log(data)
                }
            });
        }
    }

}

export default results