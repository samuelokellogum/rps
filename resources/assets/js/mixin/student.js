const student = {
    mounted(){
        var app = this
        if(window.location.href.includes("student")){
            $.ajax({
                url: base_url+"/loadAllStudents",
                success(data){
                    app.updateDataTable(app.student_list = data.students)
                    app.student_classes = data.classes
                }
            })
        }

        if(window.location.href.includes("test")){
            app.test()
        }

    },
    data(){
        return{

            student_data: {},
            student_list :{},
            student_classes: {},
            student_class_streams : {},
            student_class_form: {},
            class_name: "",
            test_data: {}
        }
    },
    methods:{
        showAddStudent(){
            this.student_data = {}
            this.imageShow = false, this.imageSrc ='';


            /*if(Object.keys(this.student_class_form).length == 0){
                swal("please select a class")
                return;
            }

            if( this.student_class_form.year == null){
                swal("please select a  Year")
                return;
            }


            if(this.student_classes[this.student_class_form.index].streams.length > 0 && this.student_class_form.stream == null){
                swal("please select a class stream")
                return;
            }*/

            $("#modal-add-student").modal("show")
        },
        addStudent(){

            var app = this
            if($("#form-add-student").valid()){

                var file_data = $('#usr_image').prop('files')[0];
                var form_data = new FormData();
                form_data.append('photo',file_data);
                var other_data = $('#form-add-student').serializeArray();
                $.each(other_data,function(key,input){
                    form_data.append(input.name,input.value);
                });
                $.ajax({
                    url: base_url+"/addStudent",
                    type: "post",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success(data){
                        //app.updateDataTable(app.student_list = data.students)
                        $("#modal-add-student").modal("hide")
                        app.$iziToast.success({
                            position: 'topCenter',
                            message: "Done!!",
                        })

                        window.location.reload(true)
                    }
                })
            }
        },

        onStudentUpdate(id){
            var app = this
            $.ajax({
                url: base_url+"/onStudentUpdate",
                data:{
                    id:id
                },
                success(data){
                    app.student_data = data

                    if(app.student_data.photo != null){
                        app.imageShow = true
                        app.imageSrc = app.storage_path+app.student_data.photo
                    }
                    $("#modal-add-student").modal("show")
                }
            })
        },
        deleteStudent(id){
            var app = this
            swal({
                title: 'Are you sure?',
                text: "Deleting student...",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: base_url+"/deleteStudent",
                        data:{
                            id:id
                        },
                        success(data){
                            app.updateDataTable(app.student_list = data.students)
                            app.$iziToast.success({
                                position: 'topCenter',
                                message: "Done!!",
                            })
                        }
                    })
                }
            })
        },
        onSelectClassChange(e){
            this.student_class_form = {}
            var class_id = this.formatClassId(e.target.value)[0]
            var index = this.formatClassId(e.target.value)[1]
            this.class_name = this.formatClassId(e.target.value)[2]
            this.student_class_streams = this.student_classes[index].streams;
            this.student_class_form.clazz_id = class_id
            this.student_class_form.index = index
        },
        onSelectStreamChange(e){
            //this.student_class_form.stream = e.target.value
        },
        onClassYearChange(e){
            //this.student_class_form.year = e.target.value
        },
        formatClassId(val){
            return val.split("-");
        },
        test(){
            var app = this
            $.ajax({
                url: base_url+"/loadAllStudents",
                success(data){
                    app.test_data = data
                }
            })
        }
    }

}


export default student