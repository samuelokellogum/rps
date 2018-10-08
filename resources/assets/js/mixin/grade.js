const grade = {
    mounted(){

        var app = this
        if(window.location.href.includes("grading")){
            $.ajax({
                url: base_url+"/loadAllGrading",
                success(data){
                    //console.log(data)
                    app.updateDataTable(app.grade_with_details = data)
                }
            })
        }

    },
    data(){
        return {
            is_grade_btn : false,
            grade_data :{},
            grade_details_data: {},
            grade_with_details: {},
            grade_details:{},
            grade_index: null
        }
    },
    methods:{
        addGrade(){
            this.grade_data = {}
            $("#modal-add-grading").modal("show")
        },
        showAddGradeDetails(id, index){
            this.grade_details_data = {}
            this.grade_details_data.grading_id = id
            this.grade_details = this.grade_with_details[index].details
            this.grade_index = index
            $("#modal-add-grade-details").modal("show")
        },
        addGrading(){
            var app = this

            if($("#form-add-grading").valid()){
                $.ajax({
                    url: base_url+"/addGrading",
                    type: "post",
                    data: $("#form-add-grading").serialize(),
                    success(data){
                        app.updateDataTable(app.grade_with_details = data)
                        $("#modal-add-grading").modal("hide")
                        app.showDefaultMethod()
                    }
                })
            }

        },
        onGradingUpdate(id){
            var app = this
            $.ajax({
                url: base_url+"/onGradingUpdate",
                data:{
                    id:id
                },
                success(data){
                    app.grade_data = data
                    $("#modal-add-grading").modal("show")
                }
            })
        },
        addGradeDetails(){
            var app = this

            if($("#form-add-grade-details").valid()){
                app.is_grade_btn = true
                $.ajax({
                    url: base_url+"/addGradeDetails",
                    type: "post",
                    data: $("#form-add-grade-details").serialize(),
                    success(data){

                        if(data.type){

                            app.toastMessage(data.message, 'error')

                        }else{


                            app.updateDataTable(app.grade_with_details = data)
                            if(app.grade_index != null){
                                app.grade_details = app.grade_with_details[app.grade_index].details
                            }
                            app.clearForm()

                            app.showDefaultMethod()


                        }

                        app.is_grade_btn = false
                    }
                })
            }


        },
        onGradeDetailUpdate(id){
            var app = this
            $.ajax({
                url: base_url+"/onGradeDetailUpdate",
                data: {
                    id: id
                },
                success(data){
                    app.grade_details_data = data

                }
            })
        },
        clearForm(){
            var grading_id = this.grade_details_data.grading_id;
            this.grade_details_data = {}
            this.grade_details_data.grading_id = grading_id
        }
    }
}

export default grade