const report = {

    mounted(){
        var app = this
        if (window.location.href.includes("viewGenReports")) {
            $.ajax({
                url: base_url + "/getAjaxClassData",
                success(data) {
                    app.student_classes = data
                }
            })
        }
    },
    data(){
        return{
            all_reports_data: {},
            report_gen_response: {},
            report_errors: "",
            show_type: "",
            promtion_data : {}
        }
    },
    methods:{
         generateReports() {

            var app = this;
            if ($("#form-gen-sreport").valid()) {
                  app.report_errors = "",
                  app.report_gen_response = {}
                  $.ajax({
                      url: base_url + "/generateReports",
                      type: "post",
                      data: $("#form-gen-sreport").serialize(),
                      success(data) {
                          if(data.error){
                              app.report_errors = data.message;
                          }else{
                              app.report_gen_response = data;
                          }
                          
                      }
                  });
            }
           
         },
         showRepGenRes(type){
             var app = this;
             this.show_type = type;
             if(type == 'promoted'){
                 app.promtion_data = app.report_gen_response.promoted_list;
             }else{
                 app.promtion_data = app.report_gen_response.not_promoted_list;
             }
             $("#modal-students").modal('show')
         },
        printReports() {
            var app = this
            var student_array = [];
            var promoted_list = app.report_gen_response.promoted_list;
            var not_promoted_list = app.report_gen_response.not_promoted_list;

            
            for(var k in promoted_list){
                student_array.push(promoted_list[k].student_id);
            }
            for(var l in not_promoted_list){
                student_array.push(not_promoted_list[l].student_id);
            }

            $.ajax({
                url: base_url + "/printReports",
                data: {
                    term: app.report_gen_response.term_id,
                    clazz: app.report_gen_response.clazz_id,
                    clazz_stream_id: app.report_gen_response.clazz_stream_id,
                    students: student_array
                },
                success(data) {
                   
                    app.all_reports_data = data
                    app.myPrintFunc('student-reports')
                }
            })
        }
    }

}

export default report;