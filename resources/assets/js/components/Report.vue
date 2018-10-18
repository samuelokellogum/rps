<template>
  
   <div id="printMe" class="row" style="padding: 25px 20px 10px 20px;">

    <!-- <div class="col-sm-4" style="width: auto">
        <img :src="storage_path+school.badge" style="width: 80px; height: 90px">
    </div>
    
    <div class="col-sm-8">
        <span style="font-size: 20px">Name: {{ school.name }}</span><br>
        <span style="font-size: 15px">Contact: {{ school.contact }}</span><br>
        <span style="font-size: 15px">Address: {{ school.address }}</span><br>
    </div> -->

    
    <div>
        <table>
            <tbody>
                <tr>
                    <td><img :src="storage_path+school.badge" style="width: 80px; height: 90px"></td>
                    <td style="padding-left: 20px">
                        <span style="font-size: 20px">Name: {{ school.name }}</span><br>
                        <span style="font-size: 15px">Contact: {{ school.contact }}</span><br>
                        <span style="font-size: 15px">Address: {{ school.address }}</span><br>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div style="height: 30%" class="col-sm-12">
        <table class="table student-data">
            <thead>
                <tr></tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="the-label">Name: </span> {{ student.name }}</td>
                    <td><span class="the-label">Class: </span> {{ clazz.name }}</td>
                    <td><span class="the-label">Year: </span> 2018</td>
                </tr>
                <tr>
                    <td><span class="the-label">Aggregate: </span>{{ report.full_report.all_avg.points }}</td>
                    <td><span class="the-label">Position: </span>{{ report.full_report.position }}</td>
                    <td><span class="the-label">Term: </span> {{ term.name }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- {{ report.full_report.results[Object.keys(report.full_report.results)[0]].result }} -->
   

 

    <div class="col-md-12">
            <table class="table table-striped table-bordered table-pretty">
                <thead>
                    <tr>
                        <th style="width: 50%"></th>
                        <th style="width: 5%" v-for="(item, index) in report.full_report.results[Object.keys(report.full_report.results)[0]].result" :key="index"> {{ index }}</th>
                        
                        <!-- @foreach (collect($results->full_report->results)->first()->result as $key => $result)
                           <th >@{{ $key }}</th>
                        @endforeach -->
                        <th style="width: 20%">Final / Remarks</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(item, index) in report.full_report.results"  :key="index">
                        <td>{{ index }}</td>
                        <td class="pretty" v-for="(item2 , index2) in item.result" :key="index2">
                            <div class="row">
                                <div v-for="(item3, index3) in item2" :class="colLength(item3.length)" :key="index3">{{ item3.mark }} | {{ item3.g_symbol }}</div>
                            </div>
                        </td>

                        <td class="pretty">
                            
                            <div class="custom-td">
                                <div>{{ item.final_result.all_average.symbol }}</div>
                                <div>{{ item.final_result.all_average.comment }}</div>
                                
                            </div>
                        </td>
                    </tr>

                    

                    
                   
                </tbody>
                <tfoot>
                    <tr>
                        <td :colspan="colSpan(report.full_report.results[Object.keys(report.full_report.results)[0]].result)" style="font-size: 20px" align="right">
                            <span style="font-weight: 600">Total: {{ report.full_report.all_avg.total }}</span> 
                        </td>
                    </tr>
                </tfoot>
            </table>

            


        <table class="table noborder" style="margin-top: 20px">
            <tbody>
                <tr>
                    <td class="title">Teacher&rsquo;s comment:</td>
                    <td style="width: 85%"><span class="raw-line"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="raw-line"></span></td>
                </tr>

                <tr>
                    <td class="title">Teacher&rsquo;s signature: </td>
                    <td><span class="raw-line" style="width: 30%"></span></td>
                </tr>

                 <tr>
                    <td class="title">HeadMaster&rsquo;s comment:</td>
                    <td style="width: 85%"><span class="raw-line"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><span class="raw-line"></span></td>
                </tr>

                 <tr>
                    <td class="title">HeadMaster&rsquo;s signature: </td>
                    <td><span class="raw-line" style="width: 30%"></span></td>
                </tr>

            </tbody>
        </table>


        <table class="table noborder">
            <tbody>
                <tr>
                    <td>Term closes on</td>
                    <td style="width: 38%"><span class="raw-line"></span></td>
                    <td>Next term begins</td>
                    <td style="width: 38%"><span class="raw-line"></span></td>
                </tr>
            </tbody>
        </table>
    </div>

    </div>

</template>

<script>
    export default {
        mounted() {
           
        },
        props:['student', 'report', 'school', 'clazz', 'term'],
        data(){
            return{
                storage_path: base_url+'/storage/'
            }
        },
        methods:{
            colLength(length){
                return "col-sm-"+Math.round(12/length);
            },
            colSpan(obj){
               
                return 2 + Object.keys(obj).length;
            }
        }
    }
</script>
