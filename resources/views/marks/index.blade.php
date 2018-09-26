@extends("layouts.app")
@section("content")



    <input hidden id="sort-by" value="{{ $sort_by }}">
    <input hidden id="sort-id" value="{{ $sort_id }}">


    <div class="row">
        <div class="col-md-3">
            <select @change="onMarkSubjectChange" class="form-control">
                <option disabled selected value="">--select subject--</option>
                <option v-for="(subject, index) in marks_subjects" :value="index">@{{ subject.name }}</option>
            </select>
        </div>

        <div v-if="marks_sub_pats.length > 0"  class="col-md-2">
            <div v-for="(sub_pat, index) in marks_sub_pats" class="form-check">
                <label v-if="selected_pats.includes(sub_pat.id)" class="cr-label">
                    <input  @change="AddOrRemove" type="checkbox" :checked="selected_pats.includes(sub_pat.id)" name="check" :value="sub_pat.id"> <span class="label-text">@{{ sub_pat.name }}</span>
                </label>
            </div>
        </div>

        <div class="col-md-3">
            <select @change="onMarkExamChange"  class="form-control">
                <option disabled selected value="">--select exam set--</option>
                <option v-for="(exam, index) in mark_exam_set" :value="index">@{{ exam.name }}</option>
            </select>
        </div>

        <div class="col-md-2">
            <select @change="onMarkTermChange"  class="form-control">
                <option disabled selected value="">--select term--</option>
                <option v-for="(term, index) in mark_terms" :value="index">@{{ term.name }} @{{ term.year }}</option>
            </select>
        </div>

        <div class="col-md-2">
            <button @click="onMarksConfirm" class="btn btn-primary">Confirm</button>
        </div>


        <div style="margin-top: 30px" class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th style="width: 10%">#</th>
                    <th style="">Name</th>
                    <th style="width: 12%"  v-for="(sub_pat, index) in marks_sub_pats" v-if="marks_sub_pats.length > 0 && selected_pats.includes(sub_pat.id)">  @{{ sub_pat.name }}  (@{{  sub_pat.short_name }})</th>
                    <th style="width: 10%"  v-if="marks_sub_pats.length == 0">@{{ marks_subject_data.name }}</th>
                </tr>
                </thead>
                <tbody class="student-marks">

                <tr v-for="(student, index) in marks_students">
                    <td>
                        @{{ index + 1 }}
                        <img v-if="student.photo != null" class="img-rounded" :src="storage_path+student.photo" style="width: 50px; height: 50px; margin-left: 10px">
                        <img v-else class="img-rounded" src="{{asset("img/userplaceholder.png")}}" style="width: 50px; height: 50px; margin-left: 10px">
                    </td>
                    <td>
                        <h4>@{{ student.name }}</h4>
                        <h6>@{{ student.reg_number }}</h6>
                        <input class="student-id" hidden :value="student.id">
                        <input class="student-name" hidden :value="student.name">
                        <input class="student-reg" hidden :value="student.reg_number">
                        <input class="student-photo" hidden :value="student.photo">
                    </td>
                    <td  v-for="(sub_pat, index) in marks_sub_pats" v-if="marks_sub_pats.length > 0 && selected_pats.includes(sub_pat.id)">
                        <input class="student-marks" :data-pat="sub_pat.id" :data-patname="sub_pat.name"  type="number">
                    </td>
                    <td v-if="marks_sub_pats.length == 0">
                        <input class="student-marks" :data-pat="marks_subject_data.id" :data-patname="marks_subject_data.name"  type="number">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


    @include("marks.modal.al_marks_preview")
@endsection