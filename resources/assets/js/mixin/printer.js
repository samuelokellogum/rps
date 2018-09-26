
const printer = {

    mounted(){},
    data(){
        return {

        }
    },
    methods:{

        printTest(id){
            printJS(id, 'html')
            //$("#"+id).printMe({ "path": [base_url+"/public/app.css"] });
        }
    }

}

export default printer