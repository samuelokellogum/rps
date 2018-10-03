
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import iziToast from './plugins/izitoast'
Vue.use(iziToast)
Vue.use(require('vue-moment'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import Clazz from "./mixin/clazz"
import Subject from "./mixin/subject"
import Term from "./mixin/term"
import Grade from "./mixin/grade"
import Student from "./mixin/student"
import ImportStudents from "./mixin/importStudents"
import Exam from "./mixin/exam"
import Marks from "./mixin/marks"
import Results from "./mixin/results"
import Printer from "./mixin/printer"
import ReportConfig from "./mixin/results_config"

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#wrapper',
    mixins:[
        Clazz, Subject, Term, Grade, Student, ImportStudents, Exam, Marks, Results,
        Printer, ReportConfig
    ],
    data:{
        imageShow: false,
        imageSrc: '',
        storage_path: base_url+"/storage/"
    },
    mounted(){
        //show swal messages
        if($("#swal-message").length > 0){
            this.showMessage($("#swal-type").val(), $("#swal-message").val())
        }
    },
    methods:{
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            var fr = new FileReader();
            fr.onload = function (e) { app.imageSrc = this.result; };
            fr.readAsDataURL(files[0]);
            app.imageShow = true;
            app.originalImage = false;
        },
        removeImage(){
            app.imageShow = false;
            app.imageSrc = "";
            $('#usr_image').val('');
        },
        changeImage(){
            app.imageShow = true;
        },
        updateDataTable(callback, timeout = 1){
            $(".data-table").DataTable().destroy()

            setTimeout(function () {
                if(callback){
                    callback
                    $(".data-table").DataTable();
                }
            }, timeout)

        }
        ,popupWindow(url, title, w, h) {
            // Fixes dual-screen position                         Most browsers      Firefox
            var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
            var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

            var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

            var left = ((width / 2) - (w / 2)) + dualScreenLeft;
            var top = ((height / 2) - (h / 2)) + dualScreenTop;
            var newWindow = window.open(url, title, 'model=yes,menubar=no,status=no,toolbar=no,location=no,width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

            // Puts focus on the newWindow
            if (window.focus) {
                newWindow.focus();
                newWindow.document.title = title
            }
        },

        formatDate(val, format = "dd/mm/yyyy"){

        },
        showMessage(type, message){
            swal({
                title: '',
                type: type,
                text: message
            }).then((res) => {
                if(res){
                    //window.location.reload(true)
                }
            })
        },
        isNumber(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }

    }
});
