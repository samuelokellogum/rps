@extends('layouts.app')
@section('content')

<div class="row">
    
    <div class="col-md-4">
         <div class="panel panel-default">
            <div class="panel-heading">Generate Reports</div>
            <div class="panel-body">
                
            <form id="form-gen-sreport" class="row" method="post" action="{{ route('generateReports') }}" >

                <div style="margin-bottom: 20px" class="col-md-12">
                    <select  name="term_id" class="form-control" required>
                        <option value="{{ $active_term->id }}">{{ $active_term->name.' '.$active_term->year }}</option>
                    </select>
                </div>


                {{ csrf_field() }}
                <?php $now = \Carbon\Carbon::now() ?>
                <div style="margin-bottom: 20px" class="col-md-12">
                    <select @change="onSelectClassChange" name="clazz_id" class="form-control" required>
                         <option value="" selected disabled>--select class --</option>
                        <option v-for="(clazz, index) in student_classes" :value="clazz.id+'-'+index+'-'+clazz.name">@{{ clazz.name }}</option>
                    </select>
                </div>

                <div v-if="student_class_streams.length > 0" style="margin-bottom: 20px" class="col-md-12">
                    <select @change="onSelectStreamChange" name="clazz_stream" class="form-control" required>
                        <option value="" selected disabled>-- select stream --</option>
                        <option v-for="(stream, index) in student_class_streams"  :value="stream.id" >@{{ stream.name }}</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="cr-label">
                        <input type="radio" name="passing_by" checked  value="marks"> <span class="label-text">Marks</span>
                    </label>
                    <label class="cr-label">
                        <input type="radio" name="passing_by"  value="points"> <span class="label-text">POINTS</span>
                    </label>
                </div>

                <div style="margin-bottom: 20px" class="col-md-12">
                    <select  name="passing_criteria" class="form-control" required>
                        <option value="above">Above</option>
                        <option value="below">Below</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="passing_value" required>
                </div>

                <div class="col-md-12" style="margin-top: 10px">
                    <label style="" class="cr-label">
                        <input type="checkbox" name="force_generation"  value="yes" >Regenerate <span class="label-text"></span>
                    </label>
                </div>


                <div class="col-md-12" style="margin-top: 10px">
                    <button type="submit" @click.prevent.stop="generateReports" class="btn btn-success">Genrate report Data</button>
                </div>

            </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Reports</div>
            <div class="panel-body">
                <template v-if="Object.keys(report_gen_response).length > 0">
                    <h6>Results: @{{ report_gen_response.promoted }} Students promoted</h6>
                    <div>
                        <a href="#" @click.prvent.stop="showRepGenRes('promoted')">Promoted</a>
                        <a href="#" @click.prvent.stop="showRepGenRes('not_promoted')">Not Promoted</a>
                    </div>

                    <div><button @click="printReports" class="btn btn-primary">Print Reports</button></div>
                </template>

                <template v-if="report_errors != ''">
                    <h6 style="color: red">Failed Generated with Errors:</h6>
                    <div v-if="report_errors.includes('marks')">
                        <a href="{{ route('grading') }}">Please accurately configure the grading used.</a>
                    </div>
                    <div v-else-if="report_errors.includes('advanced')">
                        <a href="#">Please configure advanced grading </a>
                    </div>
                    <div v-else-if="report_errors.includes('configuration')">
                        <a href="#">Please make report config</a>
                    </div>
                    <div v-else-if="report_errors.includes('generated')">
                        <a href="#">Mark the Force generetion check box to regenerate report cards</a>
                    </div>
                    <div v-else-if="report_errors.includes('class')">
                        <a href="#">Class results might be missing</a>
                    </div>
                </template>



                
            </div>
        </div>        
    </div>

</div>

    @include('report.modal.student_list')
    @include('report.modal.student_reports')
@endsection