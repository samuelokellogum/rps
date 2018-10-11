const report = {

    mounted(){

    },
    data(){
        return{
            all_reports_data: {}
        }
    },
    methods:{
        printReports() {
            var app = this
            $.ajax({
                url: base_url + "/printReports",
                data: {
                    term: 1,
                    clazz: 1,
                    by: 'stream',
                    students: [1, 2]
                },
                success(data) {
                    console.log(data)
                    app.all_reports_data = data
                }
            })
        }
    }

}

export default report;