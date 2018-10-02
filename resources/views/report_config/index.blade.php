@extends('layouts.app')
@section('content')
    <div id="score-config" class="row">
        
        <input hidden id="clazz_id" value="{{ $clazz->id }}">
        <div class="col-md-4">
            <h5>Subjects</h5>

            <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Particulars</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clazz->subjects as $key => $Subject)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $Subject->name }}</td>
                            <td><a href="#" @click.prevent.stop="showAddClassSubPat('{{ $clazz->id }}', '{{ $Subject->id }}')">{{ $clazz->patsForSubject($Subject->id)->count() }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>

        </div>

        <div class="col-md-8">
            <h5>&nbsp;</h5>
            <div class="row">
                <div class="col-md-12 my-card">
                    <div class="col-md-12" style="padding: 20px">
                        <span style="font-size: 20px; font-weight: 600" >Score Configuration </span> <button @click="confirmConfig('{{ $clazz->id }}')" class="btn btn-primary btn-sm pull-right">Confirm</button>
                    </div>
                    {{--  <h3>Score Configuration <button class="btn btn-primary btn-sm">Confirm</button></h3>  --}}
                    <hr>

                    <table class="table table-bordered config-table">
                        <thead>
                            <tr><th colspan="2">GRADING</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select id="grading" name="grading" class="form-control">
                                        @foreach (\App\Grading::all() as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button @click="showAdvancedGrading('{{ $clazz->id }}')" class="btn btn-default btn-sm">ADVANCED GRADING</button>
                                     <label style="margin-left: 30px" class="cr-label">
                                        <input type="checkbox" name="allow_advanced_grading"  value="yes"> <span class="label-text"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr class="exam_sets">
                                <td>Exam Set on final report</td>
                                <td>
                                    @foreach (\App\ExamSet::all() as $examSet)
                                    <label style="margin-left: 30px" class="cr-label">
                                        <input :checked="rc_data.exam_sets && rc_data.exam_sets.includes('{{$examSet->id}}')" type="checkbox" class="examSet"  value="{{ $examSet->id }}"> <span class="label-text">{{ $examSet->short_name }}</span>
                                    </label>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered config-table">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <h5>Marks or Score total</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="score_by">
                            <td>Sum Subject Marks: </td>
                            <td>
                                <label class="cr-label">
                                    <input type="radio" name="score_by"  value="subject" :checked="rc_data.score_by && rc_data.score_by == 'subject'"> <span class="label-text"></span>
                                </label>
                            </td>
                        </tr>
                        <tr class="score_by">
                            <td>Total per paper: </td>
                            <td>
                                <label class="cr-label">
                                    <input type="radio" name="score_by"  value="per_paper" :checked="rc_data.score_by && rc_data.score_by == 'per_paper'"> <span class="label-text"></span>
                                </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                

                    <table class="table table-bordered config-table">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <h5>Determing position</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="position_by">
                            <td>Average mark: </td>
                            <td>
                                <label class="cr-label">
                                    <input type="radio" name="position_by"  value="marks" :checked="rc_data.position_by && rc_data.position_by == 'marks'"> <span class="label-text"></span>
                                </label>
                            </td>
                        </tr>
                        <tr class="position_by">
                            <td>Points score: </td>
                            <td>
                                <label class="cr-label">
                                    <input type="radio" name="position_by"  value="points" :checked="rc_data.position_by && rc_data.position_by == 'points'"> <span class="label-text"></span>
                                </label>

                                <select id="points_by" name="points_by">
                                    <option value="asc">Points Ascending</option>
                                    <option value="desc">Points Descending</option>
                                </select>
                            </td>
                           
                        </tr>
                        </tbody>
                    </table>

                   

                </div>

              
                      

            </div>

            
        </div>

    </div>

    @include('report_config.modal.add_sub_pats')
    @include('report_config.modal.advanced_grading')
@endsection