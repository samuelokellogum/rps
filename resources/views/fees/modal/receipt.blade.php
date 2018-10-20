<!-- Modal -->
<div id="modal-receipt" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <?php $school = \App\School::find(1); ?>
            <div class="modal-body" style="padding: 25px;">
                <div v-if="Object.keys(payment_info).length > 0"   class="row receipt" id="receipt">

                  
                    <div class="show-on-print" class="col-md-12" style="height: 20px"></div>

                    <div class="col-md-12">
                        <span class="pull-right">NO. @{{ payment_info.payment.id }}</span>
                        <span class="pull-left">Date. @{{ payment_info.payment.created_at | dateFormatted }}</span>
                        <br>
                        <h4 style="text-align: center">SCHOOL FEES RECEIPT</h4>
                        <h4 style="text-align: center">{{ $school->name }}</h4>
                        <h4 style="text-align: center">{{  $school->address }}</h4>
                    </div>

                    <div class="col-md-12">
                        <table  class="table">
                            <tbody>
                                <tr>
                                    <td style="white-space: nowrap">Recieved From</td>
                                    <td colspan="3"  class="line"><div>@{{ payment_info.student.name }}</div></td>
                                </tr>
                                <tr>
                                    <td>Sum of:</td>
                                    <td colspan="3"  class="line"><div>UGX @{{ payment_info.payment.amount_paid | toMoney }}</div></td>
                                </tr>
                                <tr>
                                    <td>Payment for: </td>
                                    <td colspan="3"  class="line"><div>
                                        <span v-if="payment_info.payment.fee_for" v-for="(item , index) in payment_info.payment.fee_for">
                                            @{{ item }} <span v-if="!(index+1 == payment_info.payment.fee_for.length)">,</span></span>    
                                    </div></td>
                                </tr>
                                <tr>
                                    <td>Cash/Cheque</td>
                                    <td colspan="3"   class="line"><div></div></td>
                                </tr>

                                <tr>
                                    <td>Balance of:</td>
                                    <td colspan="3" class="line"><div>UGX @{{ payment_info.payment.balance | toMoney }}</div></td>
                                </tr>

                                <tr>
                                    <td>Recieved By</td>
                                    <td class="line"><div></div></td>
                                    <td>Signature</td>
                                    <td class="line"><div></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                
                    
                </div>

            <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" @click="printTest('receipt')" class="btn btn-primary" >Print</button>
            </div>

            </div>
           
        </div>

    </div>
</div>