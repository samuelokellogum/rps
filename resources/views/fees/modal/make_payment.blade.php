<!-- Modal -->
<div id="modal-add-payment" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-add-payment" action="#" method="post" class="row">
                    {{ csrf_field() }}
                    
                    <input hidden name="student_id" :value="student_id">
                    <input hidden name="clazz_id" value="{{ $clazz->id  }}">


                    <div class="col-md-12" v-if="show_pay_result.balance > 0">
                        <h5>Out Standing balance of: <span style="color: red; font-weight: 600">@{{ show_pay_result.balance | toMoney }}</span></h5>
                    </div>

                    <div class="col-md-12" v-if="Object.keys(show_pay_result).length > 0 && show_pay_result.amount_to_pay.toString().includes('error')">
                        <h5 style="color: red">Fees structure is not defined</h5>
                    </div>

                    <div class="col-md-12">
                        <select id="term-id" name="term_id" class="form-control">
                            <option selected disabled value="">-- Select term --</option>
                            @foreach (\App\Term::orderBy("id", "desc")->get() as $the_term)
                                <option value="{{ $the_term->id }}">{{ $the_term->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-12">
                        <input name="amount"   placeholder="Amount in money" class="form-control currency" type="text" required>
                    </div>

                    <div class="col-md-12" style="margin-top: 10px">
                        <h5>Payment for specific fee:</h5>
                        <label v-for="(item, index) in all_other_fees"  class="cr-label">
                            <input  type="checkbox" :checked="student_id == null"  name="other_fees[]" :value="item.id"> <span class="label-text">@{{ item.name }}</span>
                        </label>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" @click="confirmPayment" class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>