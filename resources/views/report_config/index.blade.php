@extends('layouts.app')
@section('content')
    <div class="row">
        
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
                    <h3>Score Configuration</h3>
                    <hr>

                    <table class="table table-bordered config-table">
                        <thead>
                            <tr><th colspan="2">GRADING</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control">
                                        @foreach (\App\Grading::all() as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button @click="showAdvancedGrading" class="btn btn-default btn-sm">ADVANCED GRADING</button>
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
                        <tr>
                            <td>Sum Subject Marks: </td>
                            <td>
                                <label class="cr-label">
                                    <input type="radio" name="score_by"  value="subject"> <span class="label-text"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Total per paper: </td>
                            <td>
                                <label class="cr-label">
                                    <input type="radio" name="score_by"  value="per_paper"> <span class="label-text"></span>
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
                        <tr>
                            <td>Average mark: </td>
                            <td>
                                <label class="cr-label">
                                    <input type="radio" name="position_by"  value="marks"> <span class="label-text"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Points score: </td>
                            <td>
                                <label class="cr-label">
                                    <input type="radio" name="position_by"  value="points"> <span class="label-text"></span>
                                </label>

                                <select name="points_by">
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