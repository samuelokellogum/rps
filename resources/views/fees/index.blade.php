@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div style="padding-bottom: 20px;" class="panel-heading">Student Types <button @click="showAddStudentType()" class="btn btn-primary btn-sm pull-right">+ Add</button></div>
            <div class="panel-body">
                <table v-if="Object.keys(all_student_types).length > 0" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th>Name</th>
                            <th style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in all_student_types">
                            <td>@{{ index+1 }}</td>
                            <td>@{{ item.name }}</td>
                            <td>
                                <button @click="showAddStudentType(index)" type="button" class="btn btn-default">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h6 v-else>NO STUDENT TYPES</h6>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div style="padding-bottom: 20px;" class="panel-heading">Other Fees <button @click="showAddOtherFees()" class="btn btn-primary btn-sm pull-right">+ Add</button></div>
            <div class="panel-body">
                <table v-if="Object.keys(all_other_fees).length > 0" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in all_other_fees">
                            <td>@{{ index+1 }}</td>
                            <td>@{{ item.name }}</td>
                            <td>@{{ item.amount | toMoney }}</td>
                            <td>
                                <button @click="showAddOtherFees(index)" type="button" class="btn btn-default">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h6 v-else>NO OTHER FEES</h6>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Class Fees</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <form id="form-fees-struct">
                            {{ csrf_field() }} 
                            <div class="col-md-12">
                                <select name="term" class="form-control" required>
                                    <option  selected value="{{ $active_term->id }}">{{ $active_term->name }}</option>
                                </select>
                            </div>

                            <div class="col-md-12" style="margin-top: 15px">
                                <select :value="fees_struct_clazz.id" name="clazz" class="form-control" required>
                                    <option disabled selected value="">--select Clazz--</option>
                                    <option v-for="(item, index) in clazzes" :value="item.id">@{{ item.name }}</option>
                                </select>
                            </div>

                            <div class="col-md-12" style="margin-top: 15px">
                                <select :value="fees_struct_student_type.id " name="student_type" class="form-control" required>
                                    <option disabled selected value="">--select Student type--</option>
                                    <option v-for="(item, index) in all_student_types"   :value="item.id">@{{ item.name }}</option>
                                </select>
                            </div>

                            <div class="col-md-12" style="margin-top: 15px">
                                <input  class="form-control currency" :value="fees_struct_desc.school_fees" name="school_fees" placeholder="School Fees" type="text" required>                                
                            </div>

                            <div class="col-md-12" style="margin-top: 15px">
                                <label v-for="(item, index) in all_other_fees"  class="cr-label">
                                    <input  type="checkbox" :checked="fees_struct_desc.hasOwnProperty(item.name)"  name="other_fees[]" :value="item.id"> <span class="label-text">@{{ item.name }}</span>
                                </label>
                            </div>


                            <div class="col-md-12">
                                <button @click.prevent.stop="confirmFeesStruct" class="btn btn-primary">Confirm</button>
                                <button @click.prevent.stop="clearFSForm" class="btn btn-primary">Clear Form</button>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-8">
                        <table v-if="Object.keys(all_fees).length > 0" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 2%">#</th>
                            <th>Class</th>
                            <th>Students</th>
                            <th>Amount</th>
                            {{--  <td>Description</td>  --}}
                            <th style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in all_fees">
                            <td>@{{ index+1 }}</td>
                            <td>@{{ item.clazz.name }}</td>
                            <td>@{{ item.student_type.name }}</td>
                            <td>@{{ item.total_amount | toMoney }}</td>
                            {{--  <td>
                                <span v-for="(item2, index2) in item.description">@{{ index2 }} : @{{ item2}}<br></span>
                            </td>  --}}
                            <td>
                                <button @click="editFeesStruct(index)" type="button" class="btn btn-default">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <h6 v-else>NO FEES STRUCTURES</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('fees.modal.add_student_type')
@include('fees.modal.add_other_fees')
@endsection