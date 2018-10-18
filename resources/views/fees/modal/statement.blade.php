<!-- Modal -->
<div id="modal-statement" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 65%">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" >
                <div class="row" v-if="Object.keys(student_statement).length > 0" id="fees-statement" style="font-family: bank-statement">

                    <div class="show-on-print" class="col-md-12">
                        <h5 style="text-align: center"><img :src="storage_path+student_statement.school.badge" style="width: 50px; height: 50px"></h5>
                        <h5 style="text-align: center">@{{ student_statement.school.name }}</h5>
                    </div>

                    <div  class="col-md-12" style="margin-top: 20px">
                        <h5 style="text-align: center">@{{ student_statement.student.name }} Payment Statement</h5>
                        <h5 style="text-align: center">@{{ student_statement.term.name }} @{{ student_statement.term.year }} </h5>
                    </div>
                    
                    <div v-if="Object.keys(student_statement).length > 0" class="col-md-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr style="background: #3B4E87; color: white">
                                    <th style="5%">Date</th>
                                    <th>Fee</th>
                                    <th style="5%">Amount</th>
                                    <th style="5%">Balance</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr v-if="student_statement.payments.length > 0" v-for="(payment, index) in student_statement.payments">
                                    <td>@{{ payment.created_at | dateFormatted }}</td>
                                    <td><span v-if="payment.fee_for" v-for="(item, index2) in payment.fee_for">@{{ item }} </span></td>
                                    <td>@{{ payment.amount_paid | toMoney }}</td>
                                    <td>@{{ payment.balance | toMoney }}</td>
                                </tr>

                                <tr v-if="student_statement.payments.length == 0">
                                    <td colspan="4" align="center">No Payments done</td>
                                </tr>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td align="right" colspan="3">Current Balance: </td>
                                    <td style="color: red" v-if="(typeof student_statement.balance === 'string')">@{{ student_statement.balance }}</td>
                                    <td v-else>@{{ student_statement.balance | toMoney }}</td>
                                </tr>    
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" @click="printTest('fees-statement')" class="btn btn-primary" >Print</button>
            </div>
        </div>

    </div>
</div>