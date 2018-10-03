const resultConfig = {

    mounted() {
        var app = this
        if($("#score-config").length > 0){
            $.ajax({
                url: base_url + "/getReportConfig",
                data:{
                    clazz_id: $("#clazz_id").val()
                },
                success(data){
                    app.rc_data = data
                }
            })
        }
    },
    data() {
        return {
            rc_subject_data: {},
            rc_subject: {},
            rc_class: {},
            rc_subject_pats: [],
            rc_adva_grades: {},
            rc_this_adva_grade: {},
            rc_data: {},
            hasError: false
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

        showAdvancedGrading(clazz_id){
            var app = this
            app.rc_this_adva_grade = {}
            $.ajax({
                url: base_url + "/getAdGrade",
                data:{
                    clazz_id : clazz_id
                },
                success(data){
                    app.rc_adva_grades = data
                    $("#modal-advanced-grading").modal('show')
                }
            })
            
        },
        addAdvancedConfig(){
            var app = this
            if ($("#form-advanced-config").valid()) {
                $.ajax({
                    url: base_url + "/addAdvancedGrade",
                    type: "post",
                    data: $("#form-advanced-config").serialize(),
                    success(data){
                        if(data.type == 'fail'){
                            swal('error', data.message, '');
                        }else{
                            app.rc_this_adva_grade = {}
                            app.rc_adva_grades = data.ad_grades
                            app.$iziToast.success({
                                position: 'topCenter',
                                message: "Subjects updated",
                            })
                        }
                        
                    }
                })
            }
        },
        editAdGrade(index){
            var app = this
            app.rc_this_adva_grade = app.rc_adva_grades[index]
        },
        confirmConfig(clazz_id){
            var app = this
            var scoreBy = $("input[name='score_by']:checked").val()
            var positionBy = $("input[name='position_by']:checked").val()
            var pointsBy = $("#points_by").val();
            var grading = $("#grading").val()
            var advanced_grade = $("input[name='allow_advanced_grading']:checked").val()
            var examSet = [];

            $(".examSet").each(function(index, item){
                if($(this).is(":checked")){
                    examSet.push($(this).val())
                }
               
            })

            var obj = {
                "score_by" : scoreBy,
                "position_by" : positionBy,
                "points_by" : pointsBy,
                "grading_id" : grading,
                "clazz_id" : clazz_id,
                "advanced_grading": advanced_grade,
                "exam_sets" : examSet
            };

            

        
            $.each(obj, function(index, item){
                if(index != "advanced_grading" && item == null){
                    app.hasError = true
                    $("."+index).css('background-color', 'red');
                    return;
                }

                if(index == "exam_sets" && item.length <= 0){
                    app.hasError = true
                    $("." + index).css('background-color', 'red');
                    return;
                }
            });

            console.log(app.hasError, obj)
            if(app.hasError){
                swal('Error','Missing Cofigurations','error');
                app.hasError = false
                return;
            }

        


            $.ajax({
                url: base_url +'/addReportConfig',
                data: obj,
                success(data){9
                    app.rc_data = data;
                    app.$iziToast.success({
                        position: 'topCenter',
                        message: "Configurations done",
                    })
                }
            })


        },
        clearErrors(){
            var obj = {
                "score_by": "scoreBy",
                "position_by": "positionBy",
                "points_by": "pointsBy",
                "grading_id": "grading",
                "clazz_id": "clazz_id",
                "advanced_grading": "advanced_grade",
                "exam_sets": "examSet"
            };


            $.each(obj, function (index, item) {
                $("." + index).css('background-color', 'white');
            });
        }
    }

}

export default resultConfig