
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
import Report from "./mixin/report.js"
import Fees from "./mixin/fees.js"

Vue.component('example', require('./components/Example.vue'));
Vue.component('report', require('./components/Report.vue'));
Vue.component('StudentReport', require('./components/StudentReport.vue'));

const app = new Vue({
    el: '#wrapper',
    mixins:[
        Clazz, Subject, Term, Grade, Student, ImportStudents, Exam, Marks, Results,
        Printer, ReportConfig, Report, Fees
    ],
    data:{
        imageShow: false,
        imageSrc: '',
        storage_path: base_url+"/storage/",
        ajax_btn_disable : false
    },
    mounted(){
        var app = this;
        //show swal messages
        if($("#swal-message").length > 0){
            this.showMessage($("#swal-type").val(), $("#swal-message").val())
        }

         //show toast
         if ($("#toast-message").length > 0) {
             this.toastMessage($("#toast-message").val(), $("#toast-type").val())
         }

        $(document).ajaxSend(function () {
            $('button').attr('disabled', true)    
        });

        $(document).ajaxComplete(function () {
            $('button').attr('disabled', false)
        });

        //image presets
        if($("#img-preset").length > 0){
            app.imageShow = true
            app.imageSrc = $("#img-preset").val()
        }
    },
    filters: {
        uppercase: function (v) {
            return v.toUpperCase();
        },
        toMoney: function(v){
            return v.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').split(".")[0]
        },
        dateFormatted(v) {
            return dateFns.format(v, 'DD/MMM/YYYY')
        },
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

            //no paging table
            $(".data-table-nopaging").DataTable().destroy()

            setTimeout(function () {
                if (callback) {
                    callback
                    $(".data-table-nopaging").DataTable({
                        paging: false
                    });
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
        toastMessage(message, type = 'success', position = 'topRight'){
            var app = this
            if(type == 'error'){
                app.$iziToast.error({
                    position: position,
                    message: message,
                    progressBar: true,
                    timeout: 8000,
                })
            }else{
                app.$iziToast.success({
                    position: position,
                    message: message,
                    progressBar: true,
                    timeout: 8000,
                })
            }
        },
        showDefaultMethod(){
            this.toastMessage('Done !!')
        },
        isNumber(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        },
         convertUTCDateToLocalDate(date) {
             var newDate = new Date(date.getTime() - date.getTimezoneOffset() * 60 * 1000);
             return newDate;
         }

    }
});
