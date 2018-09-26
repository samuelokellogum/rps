const term = {
    mounted(){

        var app = this

        if(window.location.href.includes("term")){
            $.ajax({
                url: base_url+"/loadAllTerms",
                success(data){
                    app.updateDataTable(app.all_terms = data)
                }
            })
        }

    },
    data(){
        return{

            term_data: {},
            all_terms: {}

        }
    },
    methods:{
        showAddTerm(){
            this.term_data = {}
            $("#modal-add-term").modal("show")
        },
        addTerm(){
            var app = this

            if($("#form-add-term").valid()){
                $.ajax({
                    url: base_url+ "/addTerm",
                    type: "post",
                    data: $("#form-add-term").serialize(),
                    success(data){

                        if(data.type){
                            app.$iziToast.error({
                                position: 'topCenter',
                                message: data.message,
                            })
                        }else{
                            app.updateDataTable(app.all_terms = data)
                            $("#modal-add-term").modal("hide")
                            app.$iziToast.success({
                                position: 'topCenter',
                                message: "Done!!",
                            })
                        }

                    }
                })
            }
        },
        onTermUpdate(id){
            var app = this
            $.ajax({
                url: base_url+"/onTermUpdate",
                data:{
                    id:id
                },
                success(data){
                    app.term_data = data
                    $("#modal-add-term").modal("show")
                }
            })
        }
    }
}

export default term