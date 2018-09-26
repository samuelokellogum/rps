/**
 * Created by CHARLES on 9/11/2018.
 */
$(document).ready(function(){
    $(".data-table").DataTable()

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
    $("#form-add-subject").validate()
    $("#form-add-subject-pat").validate()
    $("#form-add-term").validate()
    $("#form-add-student").validate()
    $("#form-update-temp").validate()
    $("#form-exam-set").validate()
    $("#form-update-mark").validate({
        rules:{
            mark:{
                digits: true
            }
        }
    })


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
})