import swal from "sweetalert2";

const results = {

    mounted(){},
    data(){
        return{
            results_marks:{},
            mark_data: {},
            term_update: 0,
            exam_update: 0,
            is_mark_updated: false
        }
    },
    methods:{
         showStudentMarks(id){
             var app =this
             if (!app.isNumber($("input[name=selected_exam]").val())) {
                return;
             }
             $.ajax({
                 url: base_url+"/onMarksUpdate",
                 data:{
                     id: id,
                     exam: $("input[name=selected_exam]").val(),
                     term: $("input[name=selected_term]").val(),
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

            app.exam_update = $("input[name=selected_exam]").val();
            app.term_update =  $("input[name=selected_term]").val();

            if($("#form-update-mark").valid()){
                $.ajax({
                    url: base_url+"/updateMark",
                    type: "post",
                    data:$("#form-update-mark").serialize(),
                    success(data){
                        app.results_marks = data
                        app.is_mark_updated = true
                        $("#modal-update-mark").modal("hide")
                        app.toastMessage('Marks updated')
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