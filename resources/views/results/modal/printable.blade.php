<!-- Modal -->
<div id="modal-printable-results" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 85%">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div id="print-results" class="modal-body row printThis">

                <?php
                  $the_term = \App\Term::find($selected_term);
                  $the_exam = \App\ExamSet::find($selected_exam);
                ?>

              @if($the_term != null)  
              <div class="col-md-12">
                <h3 style="text-align: center;">Results for {{ $class->name }}</h3>
                <h4 style="text-align: center;">{{  $the_term->name." ".$the_term->year." ".$the_exam->short_name }} </h4>
              </div>
              @endif
             
              <div class="col-md-12">
                 <table id="table-test" class="table table-bordered table-stripe printable-table">
                <thead>
                    <tr>
                        <th style="width: 3%">#</th>
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
                            </td>
                            <td>
                                <span>{{ $student->name }}</span><br>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button @click.prevent.stop="printTest('print-results')" type="button"  class="btn btn-primary" >Submit</button>
            </div>
        </div>

    </div>
</div>