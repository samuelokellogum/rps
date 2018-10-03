@extends("layouts.app")
@section("content")

    <div class="row">

        <form method="get" action="{{ route("results") }}">
            <input hidden name="by" value="{{ $by }}">
            <input hidden name="id" value="{{ $id }}">
            <input hidden name="selected_term" value="{{ $selected_term }}">
            <input hidden name="selected_exam" value="{{ $selected_exam }}">
        <div class="col-md-3">
            <h5>Select Term: </h5>
            <select name="term" class="form-control" required>
                @foreach($terms as $term)
                    <option {{ (isset($selected_term) && $selected_term == $term->id) ? 'selected' : '' }} value="{{ $term->id }}">{{ $term->name.' '.$term->year }}</option>
                    @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <h5>Select Exam set: </h5>
            <select name="exam" class="form-control" required>
                <option value="" selected disabled>-- select exam set --</option>
                @foreach($exam_sets as $exam_set)
                    <option {{ (isset($selected_exam) && $selected_exam == $exam_set->id) ? 'selected' : '' }} value="{{ $exam_set->id }}">{{ $exam_set->short_name }}</option>
                    @endforeach
            </select>
        </div>

         <div class="col-md-3">
             <h5>&nbsp;</h5>
             <button class="btn btn-primary">Submit</button>
             {{--  <button @click.prevent.stop="printTest('table-test')" class="btn btn-primary">Print test</button>  --}}
             <button @click.prevent.stop="showPrintable" class="btn btn-primary">View Printable</button>
         </div>

        </form>

        <div style="margin-top: 30px" class="col-md-12">

            <table id="table-test" class="table table-bordered table-stripe">
                <thead>
                    <tr>
                        <th style="width: 10%">#</th>
                        <th>Details</th>
                        <?php
                            $colspan = 0;
                        foreach ($subjects->pluck("particulars") as $row){
                            if($row->count() > 0){
                                $colspan+=$row->count();
                            }else{
                                $colspan+=1;
                            }
                        }
                        ?>
                        <th colspan="{{ $colspan }}"></th>
                    </tr>
                </thead>

                <tbody>

                <?php $count = 1 ?>
                <tr>
                    <td></td>
                    <td></td>
                @foreach($subjects as $subject)
                    <td colspan="{{ $class->patsForSubject($subject->id)->pluck("subject_pat_id")->count() }}">{{ $subject->short_name }}</td>
                  @endforeach
                </tr>

               
                <tr>
                    <td></td>
                    <td></td>
                    @foreach($subjects as $subject)
                        @if($subject->particulars->count() > 0)
                            @foreach($subject->particulars as $particular)
                                @if(in_array($particular->id, $class->patsForSubject($subject->id)->pluck("subject_pat_id")->toArray()))
                                    <td>{{ $particular->short_name }}</td>
                                    @else

                                @endif    
                            @endforeach
                        @else
                            <td></td>
                        @endif
                    @endforeach
                </tr>


                    @foreach($students as $student)
                        <tr>

                            <td>
                                {{ $count++ }}
                                <img  class="img-rounded" src="{{ ($student->photo == null) ? asset("img/userplaceholder.png") : asset("storage/{$student->photo}") }}" style="width: 50px; height: 50px; margin-left: 10px">
                            </td>
                            <td>
                                <h4><a  @click.prevent.stop="showStudentMarks({{$student->id}})" href="#">{{ $student->name }}</a></h4>
                                <h6>{{ $student->reg_number }}</h6>
                            </td>

                            @foreach($subjects as $subject)
                                @if($subject->particulars->count() > 0)
                                    @foreach($subject->particulars as $particular)
                                         @if(in_array($particular->id, $class->patsForSubject($subject->id)->pluck("subject_pat_id")->toArray()))
                                            <?php $mark = $student->mark($student->id, $selected_exam,$selected_term, $subject->id, $particular->id) ?>
                                            <td>{{ ($mark != null) ? $mark->mark : '' }}</td>
                                         @else

                                         @endif 
                                        
                                    @endforeach
                                @else
                                    <?php $mark = $student->mark($student->id, $selected_exam,$selected_term, $subject->id, null) ?>
                                    <td>{{ ($mark != null) ? $mark->mark : '' }}</td>
                                @endif
                            @endforeach

                        </tr>
                      @endforeach
                </tbody>

            </table>

        </div>

    </div>


    @include("results.modal.view_marks_detail")
    @include("results.modal.update_mark")
    @include("results.modal.printable")
    @endsection