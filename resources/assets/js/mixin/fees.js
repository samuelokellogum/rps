import swal from "sweetalert2";

const fees = {
    mounted(){
        var app = this
        if (window.location.href.includes('feesStructure')) {
            $.ajax({
                url: base_url + "/allFeesData",
                success(data){
                    app.all_student_types = data.student_types
                    app.all_other_fees = data.other_fees
                    app.clazzes = data.clazzes
                    app.all_fees = data.all_fees
                }
            })
        }

        if (window.location.href.includes("FeeStudenList")) {
            $.ajax({
                url: base_url + '/getStudentList',
                data: {
                    id : $("#class-id").val()
                },
                success(data){
                    app.fee_student_types = data.student_types;
                    app.all_other_fees = data.other_fees
                    app.updateDataTable(app.fee_student_list = data.students)
                }
            })
        }

    },
    data(){
        return{
            all_student_types: {},
            student_type: {},
            all_other_fees: {},
            other_fees: {},
            clazzes: {},
            all_fees: {},
            fees_struct:{},
            fees_struct_clazz:{},
            fees_struct_student_type:{},
            fees_struct_desc:{},
            fee_student_list: {},
            fee_student_types: {},
            student_id : null,
            show_pay_result: {},
            student_statement: {},
            payment_info: {}
        }
    },
    methods:{
        showAddStudentType(index){
            var app = this
            app.student_type = {}
            if(index != null){
                app.student_type = app.all_student_types[index]
            }
            $("#modal-add-studentType").modal('show')
        },
        showAddOtherFees(index){
             var app = this
             app.other_fees = {}
             if (index != null) {
                 app.other_fees = app.all_other_fees[index]
             }
            $("#modal-other-fees").modal('show')
        },

        addStudentType(){
            var app = this
            if($("#form-student-type").valid()){
                $.ajax({
                    url: base_url + '/addStudentType',
                    type: 'post',
                    data: $('#form-student-type').serialize(),
                    success(data){
                        app.all_student_types = data.student_types
                        app.all_other_fees = data.other_fees
                         app.clazzes = data.clazzes
                         app.all_fees = data.all_fees
                        $("#modal-add-studentType").modal('hide')
                        app.showDefaultMethod()
                    }
                })
            }

        },
        addOtherFees(){
            var app = this
            if ($("#form-other-fees").valid()) {
                $.ajax({
                    url: base_url + '/addOtherFees',
                    type: 'post',
                     data: $('#form-other-fees').serialize(),
                    success(data){
                        app.all_student_types = data.student_types
                        app.all_other_fees = data.other_fees
                         app.clazzes = data.clazzes
                         app.all_fees = data.all_fees
                        $("#modal-other-fees").modal('hide')
                        app.showDefaultMethod()
                    }
                })
            }

        },

        confirmFeesStruct(){
            var app = this;
            if ($("#form-fees-struct").valid()) {
                $.ajax({
                    url: base_url + '/confirmFeesStruct',
                    type: 'post',
                    data: $("#form-fees-struct").serialize(),
                    success(data) {
                        console.log(data)
                         app.all_student_types = data.student_types
                         app.all_other_fees = data.other_fees
                          app.clazzes = data.clazzes
                          app.all_fees = data.all_fees
                          app.clearFSForm()
                          app.showDefaultMethod()
                    }
                })

            }
            
        },
        editFeesStruct(index){
            var app = this;
            var selected_fs = app.all_fees[index]
            app.fees_struct = selected_fs
            app.fees_struct_clazz = selected_fs.clazz
            app.fees_struct_student_type = selected_fs.student_type
            app.fees_struct_desc = selected_fs.description
        },
        clearFSForm(){
            var app = this
            app.fees_struct = {}
            app.fees_struct_clazz = {}
            app.fees_struct_student_type = {}
            app.fees_struct_desc = {}
        },
        confirmStudentTypes(){
            var app =this;
            var list = [];
            $('.student-type').each(function(index, item){
                list.push($(this).val())
            })

            if(list.includes(null)){
                swal('Missing student types');
                return;
            }

            $.ajax({
                url: base_url + '/assignStudentType',
                data:{
                    list: list,
                    id: $("#class-id").val()
                },
                success(data){
                app.toastMessage("Data added!!")
                 app.updateDataTable(app.fee_student_list = data.students)
                }
            })
        },
        showAddPayment(id){
            var app = this
            this.student_id = id
            $('input[name=amount]').val('')
            $('#term-id').val('')
            $.ajax({
                url: base_url +'/showPay',
                data:{
                    student_id: id
                },
                success(data){
                    app.show_pay_result = data
                    $("#modal-add-payment").modal('show')
                }
            })
           
        },
        confirmPayment(){
            var app =this
            $.ajax({
                url: base_url + '/confirmPayment',
                type: 'post',
                data: $("#form-add-payment").serialize(),
                 success(data){
                     if(data.error){
                        app.toastMessage(data.error, 'error')
                     }else{

                        new Promise((resolve) => {
                            app.payment_info = data
                            $("#modal-add-payment").modal('hide')
                            app.toastMessage('Payment Confirmed')
                            resolve()
                        }).then(()=> {
                             $('#modal-receipt').modal('show')
                        })
                         
                        
                        // 
                     }
                 }

            })
        },

        showStatement(id){
            var app = this
            app.getStatemant(id, null)  
            $("#modal-statement").modal('show')
        },
        getStatemant(student_id, term){
            var app =this
            $.ajax({
                url: base_url + '/showStatement',
                data: {
                    student_id: student_id,
                    term: term
                },
                success(data){
                    app.student_statement = data
                    console.log(data)
                }
            })
        }, 
        showReceipt(){
            $('#modal-receipt').modal('show')
        }
        
    }
}

export default fees;