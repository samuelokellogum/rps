@extends("layouts.app")
@section("content")

<button @click="printReports">Print reports</button>

        <template v-if="Object.keys(all_reports_data).length > 0" v-for="(item, index) in all_reports_data.student_data">
                <report :term="all_reports_data.term" :clazz="all_reports_data.clazz" :school="all_reports_data.school" :student="item.student" :report="item.report"></report>
                <br>
        </template>
        
@endsection