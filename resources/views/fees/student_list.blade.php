@extends('layouts.app')
@section('content')
    <div class="row">
        <input hidden id="class-id" value="{{ $clazz->id }}"> 
        <div class="col-md-12">
            <button @click="confirmStudentTypes" class="btn btn-primary pull-right">Confirm Student Types</button>
            <button @click="showReceipt" class="btn btn-primary pull-right">Types</button>
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            
            <table class="table table-striped table-bordered data-table-nopaging">
                <thead>
                    <tr>
                        <th style="width: 2%">#</th>
                        <th style="width: 40%">Name</th>
                        <th style="width: 20%">Type</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(item, index) in fee_student_list">
                        <td>@{{ index+1 }}</td>
                        <td>@{{ item.name }}</td>
                        <td>
                            <select v-if="item.student_type.length > 0" :value="item.student_type[0].id+'-'+item.id" class="form-control student-type" required>
                                <option disabled selected value="">--Select Student Type--</option>
                                <option v-for="(item2, index2) in fee_student_types" :value="item2.id+'-'+item.id">@{{ item2.name }}</option>
                            </select>
                            <select v-else  class="form-control student-type" required>
                                <option disabled selected value="">--Select Student Type--</option>
                                <option v-for="(item2, index2) in fee_student_types" :value="item2.id+'-'+item.id">@{{ item2.name }}</option>
                            </select>
                        </td>
                        <td>
                                <button @click="showAddPayment(item.id)" :disabled="item.student_type.length == 0" class="btn btn-primary">Payment</button>
                                <button @click="showStatement(item.id)" :disabled="item.student_type.length == 0" class="btn btn-danger">Statement</button>
                        </td>
                    </tr>

                    

                    {{--  @foreach($students as $key => $student)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $student->name }}</td>
                            <td>
                                <button class="btn btn-success">Student Type</button>
                                <button class="btn btn-primary">Payment</button>
                                <button class="btn btn-danger">Statement</button>
                            </td>
                        </tr>
                    @endforeach  --}}
                </tbody>
            </table>
        </div>
    </div>

    @include('fees.modal.make_payment')
    @include('fees.modal.statement')
    @include('fees.modal.receipt')
@endsection