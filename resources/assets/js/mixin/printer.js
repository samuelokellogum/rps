
const printer = {

    mounted(){},
    data(){
        return {

        }
    },
    methods:{

        printTest(id){

            var screen_width = $(window).width()
            var screen_height = $(window).height()
            var w_cm = screen_width * 0.0264583333;
            var h_cm = screen_height * 0.0264583333;

            var dip = (screen_width * 2.54) / w_cm;

            var r_dip = Math.round(dip)

            var dips = [72, 96, 150, 300];
            var closest = dips.reduce(function (prev, curr) {
                return (Math.abs(curr - r_dip) < Math.abs(prev - r_dip) ? curr : prev);
            });
           
            var available_dips = {
                "72": "595 x 842",
                "96": "794 x 1123",
                "150": "1240 x 1754",
                "300": "2480 x 3508"
            };

            var usable_measures = available_dips[closest].split("x");
                 
            $("#" + id).css({
                'width': ''+usable_measures[1]+'px',
                'height': ''+usable_measures[1]+'px',
            })
            $("#"+id).printThis({
                debug: false,
            });
            
            //printJS(id, 'html')
            //$("#"+id).printMe({ "path": [base_url+"/public/app.css"] });
        }
    }

}

export default printer