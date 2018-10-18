const marks = {

    mounted(){

        var app = this;
        if(window.location.href.includes("marks")){
            if($("#sort-by").length > 0){
                $.ajax({
                    url: base_url+"/loadAllExamData",
                    data:{
                        id: $("#sort-id").val(),
                        by: $("#sort-by").val()
                    },
                    success(data){
                        app.marks_clazz = data.clazz;
                        app.mark_exam_set = data.exam_sets;
                        app.mark_terms = data.terms;

                        if(data.stream != null){
                            app.marks_stream = data.stream
                        }

                        app.marks_subjects = data.subjects;
                        app.marks_students = data.students;
                       // app.updateDataTable(app.marks_students = data.students)
                    }
                })
            }
        }

        
    },
    data(){
        return{
            mark_max : 0,
            mark_exam_set: {},
            mark_terms: {},
            marks_clazz: {},
            marks_stream: {},
            marks_subjects: {},
            marks_sub_pats:{},
            marks_subject_index: "",
            marks_students: {},
            input_pat:{},
            all_marks_preview: {},
            marks_subject_data:{},
            selected_pats : [],
            other_marks_data :{},
            selected_term : {},
            selected_exam : {}
        }
    },
    methods:{
        onMarksInput(e, id){
            var app = this
            var value = e.target.value
            var old_value = value.substring(0, value.length - 1)
            var new_char = value.slice(-1)

            

            if (!app.isNumber(new_char) || (parseInt(value) > parseInt(app.mark_max))) {
                $("#"+id).val(old_value)

                if (app.mark_max == 0) {
                    swal('Please select exam set');
                    return;
                }
                if ((parseInt(value) > parseInt(app.mark_max))) {
                    if ($('#help_compute').is(':checked')) {
                        //$("#" + id).val(Math.round((parseInt(value)/100)*parseInt(app.mark_max)))
                    }else{
                        swal('Maximum value should be ' + app.mark_max)
                        return;
                    }
                    
                }
            }

        


           
            
        },
        onMarkSubjectChange(e){
            var app = this;
            app.selected_pats = []
            $(".student-marks").val("");
            $(".subject-marks").attr("data-pat", "");
            $(".subject-marks").attr("data-patname", "");
            app.marks_subject_index = e.target.value;
            app.marks_sub_pats = app.marks_subjects[e.target.value].particulars
            app.marks_subject_data = app.marks_subjects[e.target.value]
            
            var allowedPats= [];
            $.ajax({
                url: base_url + "/allowedPats",
                data:{
                    clazz_id: app.marks_clazz.id,
                    subject_id: app.marks_subject_data.id,
                },
                success(data){
                    allowedPats = data
                    app.selected_pats = allowedPats  
                }
            })

           

           
             

            //remove papers

        },
        onMarkTermChange(e){
            var app = this
            app.selected_term = app.mark_terms[e.target.value]
        },
        onMarkExamChange(e){
            var app = this
            app.selected_exam = app.mark_exam_set[e.target.value]
            app.mark_max = app.selected_exam.total_mark
        },
        AddOrRemove(e){
            var app = this

            var index = app.selected_pats.indexOf(parseInt(e.target.value, 10))

            if (index > -1) {
                app.selected_pats.splice(index, 1);
            }else{
                app.selected_pats.push(parseInt(e.target.value))
            }
        },
        onMarksConfirm(){
            var app = this

            if(Object.keys(app.marks_subject_data).length == 0){
                swal('please select a subject')
                return;
            }

            if(Object.keys(app.selected_exam).length == 0){
                swal('Please select exam set')
                return;
            }

            if(Object.keys(app.selected_term).length == 0){
                swal('Please select term')
                return;
            }

            if(Object.keys(app.marks_subject_data.particulars).length > 0 && app.selected_pats <= 0){
                swal('please atleast one subject particular/ paper')
                return;
            }



            var all_students = [];
            $(".student-marks tr").each(function (index, item) {

                var student = {}
                var all_marks = []
                student.student_id = ($(this).find(".student-id").val());
                student.name = ($(this).find(".student-name").val());
                student.reg_number = ($(this).find(".student-reg").val());
                student.photo = ($(this).find(".student-photo").val());

                $(this).find(".student-marks").each(function(obj , item){

                    var marks = {
                        "paper" : $(this).attr("data-patname"),
                        "paper_id" : $(this).attr("data-pat"),
                        "mark" : $(this).val()
                    }
                    all_marks.push(marks)

                });

                student.marks = (all_marks)


                all_students.push(student)
            });

            app.all_marks_preview = all_students;
            $("#modal-all-marks-preview").modal("show")

        },
        sendMarks(all_students){
            var app = this
            $.ajax({
                url: base_url+"/onConfirm",
                data:{
                    all_content: all_students,
                    subject : app.marks_subject_data,
                    clazz: app.marks_clazz,
                    term: app.selected_term,
                    exam: app.selected_exam,
                    pats: app.selected_pats,
                    stream: app.marks_stream
                },
                success(data){

                    if(data.type){
                        app.toastMessage(data.message, 'error')
                    }else{
                         app.showDefaultMethod()
                    }
                    console.log(data)
                }
            })
        }
    }

};

export default marks