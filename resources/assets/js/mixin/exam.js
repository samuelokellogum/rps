const exam = {
    mounted(){},
    data(){
        return{
            exam_set: {}
        }
    },
    methods:{
        showAddExamSet(){
            this.exam_set = {}
            $("#modal-add-examset").modal("show")
        },
        onExamSetUpdate(id){
            var app = this
            $.ajax({
                url: base_url+"/onExamSetUpdate",
                data:{
                    id: id
                },
                success(data){
                    app.exam_set = data
                    $("#modal-add-examset").modal("show")
                }
            })
        },
        submitExamSet(){
            if($("#form-exam-set").valid()){
                $("#form-exam-set").submit()
            }
        }
    }
}

export default exam