/**
 * Created by CHARLES on 9/11/2018.
 */
$(document).ready(function(){

    $.fn.dataTableExt.sErrMode = 'throw'
    $(".data-table").DataTable()
    $(".data-table-nopaging").DataTable({
        paging: false
    })

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
    });

    $('.datepickerYear').datepicker({
        format: 'yyyy',
        viewMode: "years",
        minViewMode: "years",
        autoclose: true,
    });

    //print
 



    $("#form-add-grading").validate()
    $("#form-add-grade-details").validate({
        rules:{
            mark_end: {
                required: true,
                digits: true
            },
            mark_start: {
                required: true,
                digits: true
            },
            consist_of:{
                required: true,
                number: true
            }
        }
    })
    $("#form-school-data").validate()
    $("#form-add-subject").validate()
    $("#form-add-subject-pat").validate()
    $("#form-add-term").validate()
    $("#form-add-student").validate()
    $("#form-update-temp").validate()
    $("#form-exam-set").validate({
        rules:{
            total_mark:{
                required: true,
                min: 1,
                max: 100,
                number: true
            }
        }
    })
    $("#form-advanced-config").validate({
        rules:{
            range_1:{
                required: true,
                number:true
            },
            range_2:{
                required: true,
                number:true
            },
            consist_of:{
                required: true,
                number: true
            }
        }
    })
    $("#form-update-mark").validate({
        rules:{
            mark:{
                digits: true
            }
        }
    })

    $("#form-gen-sreport").validate({
        rules:{
            passing_value:{
                digits: true
            }
        }

    })

    $('#form-student-type').validate({
        
    })
    $('#form-other-fees').validate({

    })

    $("#form-fees-struct").validate({})


    //file chooser

    //show file name
    $(".file-picker input[type=file]").change(function () {

        var fieldVal = $(this).val();

        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");

        if (fieldVal != undefined || fieldVal != "") {
            //$(this).closest(".file-label").find(".file-name").html(fieldVal);
            $(".file-name").html(fieldVal)
        }

    });

     //maskMoney
    //  $('.currency').each(function(){
    //     $(this).maskMoney({
    //         precision: 0
    //     });
    //  })

     $('.currency').maskMoney({
         precision: 0
     });

    //  $('#currency').maskMoney({
    //      precision: 0
    //  });
     

   
})