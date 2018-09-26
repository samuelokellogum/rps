const importStudents = {

    mounted(){
        var app = this
        if(window.location.href.includes("importStudents")){
            $.ajax({
                url: base_url+"/getAjaxClassData",
                success(data){
                    app.student_classes = data
                }
            })
        }
    },
    data(){
        return{
            student_temp_data: {}
        }
    },
    methods:{

        onUpdateTempData(id){
            var app = this
            this.imageShow = false, this.imageSrc ='';
            $.ajax({
                url: base_url+"/onUpdateTempData",
                data:{
                    id: id
                },
                success(data){

                    app.student_temp_data = data
                    if(app.student_temp_data.photo != null){
                        app.imageShow = true
                        app.imageSrc = app.storage_path+app.student_data.photo
                    }


                    $("#modal-update-student").modal("show")
                }
            })
        },
        submitUpdateForm(){
            if($("#form-update-temp").valid()){
                $("#form-update-temp").submit()
            }
        }
    }

}

export default importStudents