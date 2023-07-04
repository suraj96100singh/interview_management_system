@extends('layouts.app')
@section('content')

<div class="container-fluid mt-2">
    <div class="alert alert-primary h4">
        Interviewee Records
        
        {{-- <a href="{{route('users.create')}}" class="btn btn-primary float-right mb-2" id="edit_department" onclick="resetform()">Add User</a> --}}
        
    </div>
    
    {{-- -------------------------session alerts---- --}}
    {{-- @if(Session::has('msg'))
        <div class="col-md-12 ">
            <div class="alert alert-success toggle_class"><h4>{{Session::get('msg')}}</h4></div>
        </div>
        @endif
        @if(Session::has('errormsg'))
        <div class="col-md-12">
            <div class="alert alert-danger toggle_class"><h4>{{Session::get('errormsg')}}</h4></div>
        </div>
        @endif --}}
    {{-- ----------------------------------- --}}
    {{-- <div class="form-group float-right">
        <label class="d-inline">Status :</label>
        <select id='status' class="form-control d-lg-inline" style="width: 200px">
            <option value="">--Select Status--</option>
            <option value="1">Active</option>
            <option value="0">Deactive</option>
        </select>
    </div> --}}
<div class="table-responsive" style="height:800px" >
    <table class="table table-striped table-success table-hover interview_tbl">
        <thead class="bg-dark text-white">
          
        <tr>
            <th >S.No</th>
            <th >Candidate Name</th>
            <th >Phone Number</th>
            <th >Department</th>
            <th >Email</th>
            <th >Address</th>
            <th class="text-center">Distance From Office K.M</th>
            <th >Form Submit Date</th>
            <th >Total Question</th>
            <th >Correct Question</th>
            <th >Status
                <select id='status' class="form-control d-lg-inline" style="width: 200px">
                    <option value="" >--All Detail--</option>
                    <option value="pending">Pending</option>
                    <option value="accept">Accept</option>
                    <option value="reject">Reject</option>
                </select>
            </th>
            <th class="text-center">Action</th>
        </tr>
        
    </thead>
    {{-- <tbody>
      @if(count($candidate_detail))
      @foreach ($candidate_detail as $candidate_detail_val)

      
      
      
            <tr>
                <td class="text-center">{{ $loop->iteration}}</td>
                <td class="text-center">{{ $candidate_detail_val->candidate_name}}</td>
                <td class="text-center">{{ isset($candidate_detail_val->departmentName->department_name)?$candidate_detail_val->departmentName->department_name:'N/A'}}</td>
                <td class="text-center">{{ $candidate_detail_val->candidate_number}}</td>
                <td class="text-center">{{ $candidate_detail_val->candidate_email}}</td>
                <td class="text-center">{{ $candidate_detail_val->candidate_permanent_address}}</td>
                <td class="text-center">{{ $candidate_detail_val->candidate_form_filling_date}}</td>
                <td class="text-center">{{ $candidate_detail_val->total_question??'N/A'}}</td>
                <td class="text-center">{{ $candidate_detail_val->total_correct_question??'N/A'}}</td>
                <td class="text-center">
                    <select  @if($candidate_detail_val->candidate_status=='accept') class='btn btn-success myselect mt-1' disabled @elseif ($candidate_detail_val->candidate_status=='reject') class='btn btn-danger myselect mt-1' disabled @else class=' btn btn-primary myselect mt-1' @endif name="candidate_status" id="{{ $candidate_detail_val->id }}">
                    <option value="pending"  @if($candidate_detail_val->candidate_status=='pending') selected @endif>Pending</option>
                    <option value="accept"  @if($candidate_detail_val->candidate_status=='accept') selected @endif >Accept</option>
                    <option value="reject"  @if($candidate_detail_val->candidate_status=='reject') selected @endif >Reject</option> 
                </select></td>
                <td class="text-center"><button class="btn btn-primary show_full_detail text-nowrap mt-1"data-toggle="modal" data-target="#candidateModal" value="{{ $candidate_detail_val->id }}" name="action">view detail</button></td>
            </tr>
        
        @endforeach
        @else
        <tr>
            <td colspan="8" class="text-center">Record Not Found</td>
        </tr>
        @endif
    </tbody> --}}
    </table>
    </div>
</div> 
{{-- candidate detail model start --}}
{{-- <div id="printThis"> --}}
    <div class="modal fade" id="candidateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content rounded">
                <div class="modal-header alert alert-primary h4">
                    <header>
                        <h2>Candidate Details</h2>
                    </header>
                    <i class="fa-solid fa-xmark fa-fade close pull-right" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="refresh()"></i>
                </div>  
            <div id="printThis">
                <div class="modal-body ">
                    <div id="success_message_id">
                    </div>
                    <div class="card-body" id="all_detail" class="border-1px"> 
                    </div>
                </div>
            </div>
            <div class="text-center mb-5 ">
                <button type="button" class="btn btn-primary" onclick="print_detail(document.getElementById('printThis'))">Print</button>
            </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
{{-- candidate detail model end --}}
{{-- candidate accept status model start --}}
<div class="modal fade" id="candidateacceptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded">
            <div class="modal-header alert alert-primary h4">
                <header>
                    <h2>Make Employee</h2>
                </header>
                <i class="fa-solid fa-xmark fa-fade close pull-right" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="refresh()" id="refresh_data"></i>
            </div>        
            <div class="modal-body ">
                <div id="success_message_id">
                </div>
                
                  <form method="post" class="employeesubmit" id="employeesubmit"  action="">
                    @csrf
                    
                    
                    <div class="card-body" id="make_employee_detail" class="border-1px"> 
                    {{-- all detail will show here --}}
                    

                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- candidate accept status model end --}}

<script>
$(document).ready(function () {
    $('.toggle_class').toggle(2000)
    
});
// candidate full detail show
$(document).on('click','.show_full_detail',function(e){
    e.preventDefault;

   var content= `<h3 class="mb-5"><b id="candidate_name" ></b></h3>
                    <div>
                        <label for="" class="mr-3"><b>Phone</b></label>
                        <span id="phoneno"></span>
                    </div>
                    <div>
                    <label for="" class="mr-4"><b>Email</b></label>
                    <span id="email"></span>
                    </div>
                    <div>
                    <label for="" class="mr-2"><b>Address</b></label>
                    <span id="address"></span>
                    </div>
                    <h5 class="mt-5"><b>Experience</b></h5>
                    <hr>
                    <div id="experience_table_show">

                    </div>
                    <h5 class="mt-5"><b>Education</b></h5>
                    <hr>
                    <div id="education_table_show">

                    </div>
                    <h5 class="mt-5"><b>Soft Skill</b></h5>
                    <hr>
                    <div id="soft_skill_show">
                    </div>
                    <hr>
                   <!-- first row address,age,dob,marriage status detail -->
                    <div class='row'>
                        <div class="col-sm">
                            <label><b>Current Address :</b></label>
                           <span id="current_address" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Age :</b></label>
                           <span id="candidate_age" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Date of Birth :</b></label>
                           <span id="candidate_dob" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Married :</b></label>
                            <span id="married_status" class='d-block w-100 text-wrap'></span>
                        </div>
                    </div>
                    <!-- second row  ousidebkn,refrece_person_name,earlier_tour,special_knowledge-->
                    <div class='row mt-5'>
                        <div class="col-sm">
                            <label><b>Ready To Go Outside Bikaner :</b></label>
                           <span id="ready_to_go_outside_bikaner" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Refrence Person Name :</b></label>
                           <span id="refrence_person_name" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Earlier Tour :</b></label>
                           <span id="earlier_tour" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Special Knowledge :</b></label>
                            <span id="special_knowledge" class='d-block w-100 text-wrap'></span>
                        </div>
                    </div>
                    <!-- thired row  -->
                    <div class='row mt-5'>
                        <div class="col-sm">
                            <label><b>Candidate Have Licence :</b></label>
                           <span id="candidate_have_licence" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Candidate Have PAN :</b></label>
                           <span id="candidate_have_pan" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Candidate Habit :</b></label>
                           <span id="candidate_any_habit" class='d-block w-100 text-wrap'></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Candidate Medical Problem :</b></label>
                            <span id="candidate_medical_problem" class='d-block w-100 text-wrap'></span>
                        </div>
                    </div>
                    <!-- forth row  -->
                    <div class='row mt-5'>
                        <div class="col-sm">
                            <label><b>Candidate Expection :</b></label>
                           <span id="candidate_expection" class='d-block w-100 text-wrap'></span>
                        </div>
                    </div>
                    
                    `
          $('#all_detail').html(content);
    var candidate_id=$(this).val();
    // console.log(candidate_id);
    $('#candidateModal').modal({backdrop: 'static', keyboard: false});
    $.ajax({
        type:'GET',
        url:'interviewers/'+candidate_id,
        success: function(responce){
            console.log(responce);
            $('#candidate_name').html(responce.candidate_full_details.candidate_name?responce.candidate_full_details.candidate_name:'N/A');
            $('#phoneno').html(responce.candidate_full_details.candidate_number?responce.candidate_full_details.candidate_number:'N/A');
            $('#email').html(responce.candidate_full_details.candidate_email?responce.candidate_full_details.candidate_email:'N/A');
            $('#address').html(responce.candidate_full_details.candidate_permanent_address?responce.candidate_full_details.candidate_permanent_address:'N/A');
            $('#current_address').html(responce.candidate_full_details.candidate_current_address?responce.candidate_full_details.candidate_current_address:'N/A');
            $('#candidate_age').html(responce.candidate_full_details.candidate_age?responce.candidate_full_details.candidate_age:'N/A');
            $('#candidate_dob').html(responce.candidate_full_details.candidate_dob?responce.candidate_full_details.candidate_dob:'N/A');
            $('#married_status').html(responce.candidate_full_details.candidate_marriage_status?responce.candidate_full_details.candidate_marriage_status:'N/A');
            $('#ready_to_go_outside_bikaner').html(responce.candidate_full_details.candidate_if_ready_to_go_outside_bikaner?responce.candidate_full_details.candidate_if_ready_to_go_outside_bikaner:'N/A');
            $('#refrence_person_name').html(responce.candidate_full_details.candidate_reference_person_name?responce.candidate_full_details.candidate_reference_person_name:'N/A');
            $('#earlier_tour').html(responce.candidate_full_details.earlier_tour?responce.candidate_full_details.earlier_tour:'N/A');
            $('#special_knowledge').html(responce.candidate_full_details.candidate_any_special_knowledge?responce.candidate_full_details.candidate_any_special_knowledge:'N/A');
            // ----
            $('#candidate_have_licence').html(responce.candidate_full_details.candidate_have_DL_status?responce.candidate_full_details.candidate_have_DL_status:'N/A');
            $('#candidate_have_pan').html(responce.candidate_full_details.candidate_have_PAN_status?responce.candidate_full_details.candidate_have_PAN_status:'N/A');
            $('#candidate_any_habit').html(responce.candidate_full_details.candidate_any_habits?responce.candidate_full_details.candidate_any_habits:'N/A');
            $('#candidate_medical_problem').html(responce.candidate_full_details.candidate_any_medical_problem?responce.candidate_full_details.candidate_any_medical_problem:'N/A');
            $('#candidate_expection').html(responce.candidate_full_details.candidate_expected_salary?responce.candidate_full_details.candidate_expected_salary:'N/A');

            // experience table show start
            var table = "<table border=1 class='table table-bordered table-hover'>";
            table += `<tr>
            <th>S.No</th>
            <th>Company Name</th>
            <th>Experience</th>
            <th>Salary Per Month</th>
            <th>Reason For Leaving</th>
            </tr>`;
            total_length_data=responce.candidate_full_details.work_experience_info.length;
           if(total_length_data>1){
            for(let i=0;i<total_length_data;i++){
            table +=`<tr> 
               <td>${[i+1]}</td>
                <td>${responce.candidate_full_details.work_experience_info[i]['candidate_company_name']}</td>
                <td>${responce.candidate_full_details.work_experience_info[i]['candidate_work_experience']}</td>
                <td>${responce.candidate_full_details.work_experience_info[i]['candidate_salary_per_month']}</td>
                <td>${responce.candidate_full_details.work_experience_info[i]['reason_for_leaving_previous_company']}</td>
            </tr>`;
             }
           }else{
            table +=`<tr>
                <td colspan="5" class="text-center text-danger">Candidate Have No Experience</td>`
           }
            table += "</table>";
            $('#experience_table_show').html(table);
            // experience table show end
            // education table show start
            var educationtable = "<table border=1 class='table table-bordered table-hover'>";
            educationtable += `<tr>
            
            <th>level</th>
            <th>Marks%</th>
            <th>Institution Name</th>
            <th>Medium(Hindi/English)</th>
            </tr>`;
           
            educationtable +=`<tr> 
                <td >10th</td>
                <td>${responce.candidate_full_details.candidate_10th_marks?responce.candidate_full_details.candidate_10th_marks:'N/A'}</td>
                <td>${responce.candidate_full_details.candidate_10th_institution_name?responce.candidate_full_details.candidate_10th_institution_name:'N/A'}</td>
                <td>${responce.candidate_full_details.candidate_10th_medium?responce.candidate_full_details.candidate_10th_medium:'N/A'}</td>
                
            </tr>
            <tr>
                <td >12th (${responce.candidate_full_details.candidate_12th_subject_name?responce.candidate_full_details.candidate_12th_subject_name:'N/A'})</td>
                <td>${responce.candidate_full_details.candidate_12th_marks?responce.candidate_full_details.candidate_12th_marks:'N/A'}</td>
                <td>${responce.candidate_full_details.candidate_12th_institution_name?responce.candidate_full_details.candidate_12th_institution_name:'N/A'}</td>
                <td>${responce.candidate_full_details.candidate_12th_medium?responce.candidate_full_details.candidate_12th_medium:'N/A'}</td> 
            </tr>
            <tr>
                <td>Graduation (${responce.candidate_full_details.candidate_graduation_subject?responce.candidate_full_details.candidate_graduation_subject:'N/A'})</td>
                <td>${responce.candidate_full_details.candidate_graduation_percentages?responce.candidate_full_details.candidate_graduation_percentages:'N/A'}</td>
                <td>${responce.candidate_full_details.candidate_graduation_institution_name?responce.candidate_full_details.candidate_graduation_institution_name:'N/A'}</td>
                <td>${responce.candidate_full_details.candidate_graduation_medium?responce.candidate_full_details.candidate_graduation_medium:'N/A'}</td> 
            </tr>
            <tr>
                <td>PG/Deploma (${responce.candidate_full_details.candidate_pg_or_deploma_subject?responce.candidate_full_details.candidate_pg_or_deploma_subject:'N/A'})</td>
                <td>${responce.candidate_full_details.candidate_pg_or_deploma_percentages?responce.candidate_full_details.candidate_pg_or_deploma_percentages:'N/A'}</td>
                <td>${responce.candidate_full_details.candidate_pg_or_deploma_institution_name?responce.candidate_full_details.candidate_pg_or_deploma_institution_name:'N/A'}</td>
                <td>${responce.candidate_full_details.candidate_pg_or_deploma_medium?responce.candidate_full_details.candidate_pg_or_deploma_medium:'N/A'}</td> 
            </tr>`;
             
        
            educationtable += "</table>";
            $('#education_table_show').html(educationtable);
            // education table show end
            console.log(responce.candidate_full_details.candidate_soft_skills);
            if(responce.candidate_full_details.candidate_soft_skills){
                var split_skills=responce.candidate_full_details.candidate_soft_skills.split(',');
            const chunksize=3;
            var soft_skill_val=`<div class="d-flex ">`;
            for(let i=0;i<split_skills.length; i += chunksize){
                const chunk = split_skills.slice(i, i + chunksize);
                 soft_skill_val+=`<span class='mr-5'>`;
                for(let j=0;j<chunk.length;j++){
                    // console.log(chunk[j]);
                    soft_skill_val+=`<li>${chunk[j]}</li>`;
                }
                 soft_skill_val+=`</span>`;  
            }
            soft_skill_val+=`</div>`;
            // console.log(soft_skill_val);
            $('#soft_skill_show').html(soft_skill_val);
            }else{
            $('#soft_skill_show').html(`<p class='text-center text-danger'>Candidate Have No Skills</p>`);
            }
             
        }
        

    })
    
})

$(document).ready(function(){ //Make script DOM ready
    // $('.myselect').change(function() { //jQuery Change Function
    $(document).on('change' ,'.myselect' , function() { //jQuery Change Function
        // alert('hello')
        var opval = $(this).val(); //Get value from select element
        console.log(opval);
        var employee_id=($(this).attr('id'));
        console.log(employee_id);
    if(opval=="accept"){ //Compare it and if true
            $('#candidateacceptModal').modal({backdrop: 'static', keyboard: false});
            $('#candidateacceptModal').modal("show"); //Open Modal
        
        // if(opval=="reject"){
        //     alert("do you reallly want to do this task");
        // }
        // var employee_id=($(this).attr('id'));
        // console.log(employee_id);

        $.ajax({
            type:'GET',
            url:'interviewers/'+employee_id,
            success: function (employee_detail) {
                // (employeesubmit
                // if(opval=="reject"){
                //  alert("do you reallly want to do this task");

                //  }
                console.log(employee_detail);
                let employee_detail_field=`
                    <div class='row'>
                        
                        <div class="col-sm">
                            <label><b>Employee Name :</b></label>
                           <span id="employee_name" class='d-block w-100 text-wrap'>${employee_detail.candidate_full_details.candidate_name}</span>
                        </div>
                        <div class="col-sm">
                            <label><b>Employee Department :</b></label>
                           <span id="employee_department" class='d-block w-100 text-wrap'>${employee_detail.candidate_full_details.department_name?employee_detail.candidate_full_details.department_name.department_name:'N/A'}</span>
                        </div>
                        <div class="col-sm">
                            <label><b>Employee Expecting Salary :</b></label>
                           <span id="employee_expected" class='d-block w-100 text-wrap'>${employee_detail.candidate_full_details.candidate_expected_salary}</span>
                        </div>
                    </div>
                    <hr>
                    <div id="empty_div"></div>
                    <div id='div_hide'>
                    <div class='text-center h5 mb-5'><label><b>Fill Employee Details</b></label></div>
                    <div class='row'>
                        <div class="col-sm">
                            <label><b>Role :</b></label>
                            <select class="form-control employee_role" aria-label="Default select example" name="employee_role" required="required">
                            <option selected disabled >Select Any One</option>
                            <option value="tester">Tester</option>
                            <option value="developer">Developer</option>
                            <option value="accountant">Accountant</option>
                            <option value="accountant">Support</option>
                            </select>
                            <span id="employee_role_selection_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Offered Salary :</b></label>
                            <input type="text"  class="form-control" name="offered_salary" oninput="this.value = this.value.replace(/[^0-9.]/g, '');"/>
                            <input type="hidden" name="employee_status" value="accept">
                            <span id="employee_offered_salary_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Data of Joining :</b></label>
                            <input type="date" name="joining_date" class="form-control">
                            <span id="employee_joining_date_error" class="text-danger"></span>
                        </div>
                        <div class="col-sm">
                            <label><b>Employment Type :</b></label>
                            <select class="form-control " aria-label="Default select example" name="employment_type">
                            <option selected disabled>Select Any One</option>
                            <option value="daily">Daily</option>
                            <option value="hourly">Hourly</option>
                            </select>
                            <span id="employee_employement_type_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mt-5"><b>Remarks :</b></label>
                        <textarea  name="employee_remark" rows="4" cols="50" class="form-control" ></textarea>
                        <span id="employee_remarks_error" class="text-danger"></span>
                    </div>
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-outline-primary" name="employee_detail"value="employee_detail" onclick="employeesubmit(${employee_id})" id="employee_submit">Submit</button>
                    </div>
                    </div>`;
                    $('#make_employee_detail').html(employee_detail_field);
            }
            

            

        });
        
    }else{
        // alert(employee_id);
        // if(!confirm("Do You Really Want to Delete this Field")){
        //     window.top.location = window.top.location
        //     return;
        // }
        swal({
                title: `Are You sure want to Reject This Candidate ?`,
                text: "If you Reject,Rejection mail will be send to the candidate",
                // text:"Loading...",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willProceed) => {
                
            if (willProceed) {
                $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                });
                var token = $('meta[name="csrf-token"]').attr("content");
                
                swal({
                        title:"", 
                        text:"Sending the Mail...",
                        icon: "https://www.boasnotas.com/img/loading2.gif",
                        // showSpinner: true,
                        buttons: false,      
                        closeOnClickOutside: false, 
                        })
                $.ajax({
                    type: "PUT",
                    data: {employee_status : 'reject',_token:token},
                    dataType: "json",
                    url: "/interviewers/" + employee_id,
                    // beforeSend:function(){
                      
                    // },
                    success: function (employee_status_res) {
                        // Swal.fire('Please wait');
                        swal.close(); 
                        // console.log(employee_status_res);
                        // window.location.href = "/interviewers";
                        var element = document.getElementById('status');
                        var event = new Event('change');
                        element.dispatchEvent(event);
                       

                    }
                });
        }else{
            //it will go to select status tag header and autumatically all detail page
            document.getElementById('status').selectedIndex = 0;
            document.getElementById('status').dispatchEvent(new Event('change'));
            // var element = document.getElementById('status').selectedIndex;
            // var event = new Event('change');
            // console.log(element);
            // element.dispatchEvent(event);
        }
    }) 
    }
    });  
});
function refresh(){
    document.getElementById("all_detail").innerHTML="";
    document.getElementById("make_employee_detail").innerHTML="";
    document.getElementById('status').selectedIndex = 0;
    document.getElementById('status').dispatchEvent(new Event('change')); 
}


</script>

@endsection