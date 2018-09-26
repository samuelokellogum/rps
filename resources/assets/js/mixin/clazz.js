const clazz = {

    mounted(){
        var app = this
        if(window.location.href.includes("clazz")){
            $.ajax({
                url: base_url+"/loadClassList",
                success(data){
                    //console.log(data)
                    app.updateDataTable(app.class_with_streams = data)
                }
            })
        }

    },
    data(){
        return{
            class_data: {},
            class_stream_data: {},
            class_with_streams: {},
            class_streams: {},
            class_stream_index : null
        }
    },
    methods:{
        addClazz(){
            this.class_data = {}
            $("#modal-add-clazz").modal("show")
        },
        onClazzUpdate(id){
            var app = this
            $.ajax({
                url: base_url+"/onClassUpdate",
                data:{
                    id: id
                }, success(data){
                    app.class_data = data
                    $("#modal-add-clazz").modal("show")
                }
            })

        },
        addClazzStream(id){
            this.class_stream_data = {}
            this.class_stream_data.clazz_id = id
            $("#modal-add-clazz-stream").modal("show")
        },
        onClazzStreamUpdate(id){
            var app = this
            $.ajax({
                url: base_url+"/onClassStreamUpdate",
                data:{
                    id: id
                }, success(data){
                    app.class_stream_data = data
                    $("#modal-add-clazz-stream").modal("show")
                }
            })

        },
        addClassData(){

            var app = this
            $.ajax({
                url: base_url+"/addClassData",
                type: "post",
                data:$("#form-add-class").serialize(),
                success(data){
                    app.updateDataTable(app.class_with_streams = data)
                    $("#modal-add-clazz").modal("hide")
                    console.log(data)
                }
            })
        },
        addClassStream(){
            var app = this
            $.ajax({
                url: base_url+"/addClassStream",
                type: "post",
                data:$("#form-add-class-stream").serialize(),
                success(data){
                    app.updateDataTable(app.class_with_streams = data)
                    $("#modal-add-clazz-stream").modal("hide")

                    if(app.class_stream_index != null){
                        app.class_streams = app.class_with_streams[app.class_stream_index].streams
                    }

                    console.log(data)
                }
            })
        },
        showStreams(index){
            var app = this
            app.class_streams = app.class_with_streams[index].streams
            app.class_stream_index = index
            $("#show-streams").modal("show")
        }
    }

}

export default clazz