const subject = {

    mounted(){

        var app = this
        if(window.location.href.includes("subject")){
            $.ajax({
                url: base_url+"/loadAllSubjects",
                success(data){
                    //console.log(data)
                    app.updateDataTable(app.subjects_with_pats = data)
                }
            })
        }

        if(window.location.href.includes("classSubject")){
            $.ajax({
                url: base_url+"/loadAllClassWithSubjects",
                success(data){
                    app.subjects_list = data.subjects;
                    app.updateDataTable(app.class_with_subjects = data.class_with_subjects)
                }
            })
        }

    },
    data(){
        return{
            is_subject_btn: false,
            subject_data: {},
            subjects_with_pats: {},
            subject_pat_data: {},
            subject_pats:{},
            subject_index: null,
            class_with_subjects: {},
            subjects_list:{},
            class_subjects :{},
            class_subjects_array: [],
            class_sub_id: ""

        }
    },
    methods:{
        showAddSubject(){
            this.subject_data = {}
            $("#modal-add-subject").modal("show")
        },
        showAddSubjectPat(id, index){
            this.subject_pat_data = {}
            this.subject_pat_data.subject_id = id
            this.subject_pats = this.subjects_with_pats[index].particulars
            this.subject_index = index
            $("#modal-add-subject-pats").modal("show")
        },
        addSubject(){
            var app = this
            if($("#form-add-subject").valid()){
                $.ajax({
                    url: base_url+"/addSubject",
                    type: "post",
                    data: $("#form-add-subject").serialize(),
                    success(data){
                        $("#modal-add-subject").modal("hide")
                        app.updateDataTable(app.subjects_with_pats = data)
                        app.$iziToast.success({
                            position: 'topCenter',
                            message: "Done!!",
                        })
                    }
                })
            }
        },
        onSubjectUpdate(id){
            var app = this
            $.ajax({
                url: base_url+"/onSubjectUpdate",
                data:{
                    id:id
                },
                success(data){
                    app.subject_data = data;
                    $("#modal-add-subject").modal("show")
                }
            })
        },
        addSubjectPat(){
            var app = this
            if($("#form-add-subject-pat").valid()){
                app.is_subject_btn = true
                $.ajax({
                    url: base_url+"/addSubjectPat",
                    type:"post",
                    data: $("#form-add-subject-pat").serialize(),
                    success(data){
                        app.updateDataTable(app.subjects_with_pats = data)
                        if(app.subject_index != null){
                            app.subject_pats = app.subjects_with_pats[app.subject_index].particulars
                        }
                        app.$iziToast.success({
                            position: 'topCenter',
                            message: "Done!!",
                        })

                        app.clearSubForm()

                        app.is_subject_btn = false
                    }
                })
            }
        },
        onSubjectPatUpdate(id){
            var app = this
            $.ajax({
                url : base_url+"/onSubjectPatUpdate",
                data:{
                    id:id
                },
                success(data){
                    app.subject_pat_data = data
                }
            })
        },
        clearSubForm(){
            var subject_id = this.subject_pat_data.subject_id
            this.subject_pat_data = {}
            this.subject_pat_data.subject_id = subject_id
        },
        showSubjectList(id, index){
            var app = this
            app.class_subjects_array = []
            this.class_sub_id = id
            app.class_subjects = this.class_with_subjects[index].subjects

            app.class_subjects.forEach(function(obj){
                app.class_subjects_array.push(obj.id)
            })


            $("#modal-list-subjects").modal("show")
        },
        confirmSubjects(){
            var app = this
            var subjects = [];
            $(".subject_check").each(function (index, item) {
                if($(this).is(':checked')){
                    subjects.push($(this).val())
                }
            })

            $.ajax({
                url: base_url+"/addClassSubject",
                data: {
                    subjects: subjects,
                    clazz_id: app.class_sub_id
                },
                success(data){
                    app.subjects_list = data.subjects;
                    app.updateDataTable(app.class_with_subjects = data.class_with_subjects)
                    $("#modal-list-subjects").modal("hide")
                    app.$iziToast.success({
                        position: 'topCenter',
                        message: "Subjects updated",
                    })
                }
            })
        }

    }

}

export default subject