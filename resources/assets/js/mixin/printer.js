
const printer = {

    mounted(){
        
        var app = this
    },
    data(){
        return {
            original_html: "",
            printable_thml: "",
            is_printing: false,
        }
    },
    methods:{

        myPrintFunc(id){
            var app = this
             app.original_html = document.body.innerHTML;
         
            setTimeout(() => {
                     var pageSize = app.printablePageSize();
                   $("#" + id).css({
                       'height': pageSize.height,
                   })
                    app.printable_thml = document.getElementById(id).innerHTML;
                   document.body.innerHTML = app.printable_thml;
                    window.location.reload(true);
                   window.print();
                    
            },200);

           
        },

        printablePageSize(){
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
            return {
                'width': '' + usable_measures[1] + 'px',
                'height': '' + usable_measures[1] + 'px',
            };
        },

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

            var original_width = $("#" + id).width()
            var original_height = $("#" + id).height()
           
            var available_dips = {
                "72": "595 x 842",
                "96": "794 x 1123",
                "150": "1240 x 1754",
                "300": "2480 x 3508"
            };

            var usable_measures = available_dips[closest].split("x");
                 
            $("#" + id).css({
                'width': ''+usable_measures[1]+'px',
                'height': ''+usable_measures[0]+'px',
            })
           
            $("#"+id).printThis({
                debug: false,
            });

            setTimeout(() => {
                $("#" + id).css({
                    'width': '' + original_width + 'px',
                    'height': '' + original_height + 'px',
                })
            }, 500);
           
            
            //printJS(id, 'html')
            //$("#"+id).printMe({ "path": [base_url+"/public/app.css"] });
        }
    }

}

export default printer