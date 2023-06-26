@extends('layouts.app')
@section('content')
{{-- @include('header.head') --}}
    {{-- -----------------------------alert header --}}
    
    <div class="m-3">
        <div class="form-group">
            <div class="alert alert-primary">
                <h3>Interview Questionnaries</h3>
            </div>
        </div>
    </div>
    {{-- end alert header --}}
    {{-- form start --}}

    <div class="alert alert-danger print-error-msg m-5 d-none"  id="errors">
       
    </div>
    <div class="row">
        <div class="mx-auto col-10 col-md-8 col-lg-8">
            <form class="form" method="post" enctype="multipart/form-data">
             @csrf
                <div>
                    <h4><b>Personal Information</b></h4>
                    <hr>
                </div>
                <div class="form-inline m-5">
                    <div class="form-group ml-2">
                        <label for="">
                            <h5>Candidate Name</h5>&nbsp;&nbsp;&nbsp;&nbsp;
                        </label>
                        <input type="text" class="form-control ml-4" placeholder="Enter Full Name" id="candidate_name"
                            name="candidate_name">
                    </div>


                    <div class="form-group ml-5">
                        <label for="">
                            <h5>Date Of Birth</h5>
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" class="form-control" id="candidate_dob"
                            name="candidate_dob" oninput="ageFind(this.value)" >
                            {{-- <p class="text-danger"  style="display:none"  id="candidateDob"></p> --}}

                    </div>
                    <div class="form-group ml-5">
                        <label for="">
                            <h5>Age</h5>
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="number" class="form-control" id="candidate_age" min="0" name="candidate_age" readonly>
                    </div>
                    <div class="form-group ml-2 mt-4">
                        <label for="">
                            <h5>Personal Number</h5>&nbsp;&nbsp;&nbsp;
                        </label><input type="number" class="form-control ml-4" id="candidate_number" placeholder="Enter Number"
                            name="candidate_number">
                            {{-- <p class="text-danger" style="display:none" id="candidateNo"></p> --}}
                    </div>
                    <div class="form-group ml-5 mt-4">
                        <label for="">
                            <h5>Candidate Email</h5>&nbsp;&nbsp;&nbsp;&nbsp;
                        </label><input type="email" class="form-control ml-2 " id="candidate_Email" placeholder="Enter Email"
                            name="candidate_Email">

                    </div>
                    <div class="form-group ml-4 mt-4">
                        <label for=""><b>Married</b></label>
                        <label for="meriyes" class="ml-3">Yes</label>
                        <input type="radio" name="candidate_marriage_statuss" id="candidate_marriage_statuss" value="Yes" id="meriyes"
                            class="ml-3">
                        <label for="merino" class="ml-3">No</label>
                        <input type="radio" name="candidate_marriage_statuss" id="candidate_marriage_statuss" value="No" id="merino"
                            class="ml-3">
                    </div>
                    <div class="form-group mt-4 ml-2">
                        <label for="">
                            <h5>Permanent Address</h5>
                        </label>
                        <textarea name="candidate_permanent_address"  id="candidate_permanent_address" cols="97" rows="" class="form-control  ml-3 "></textarea>
                        {{-- <p class="text-danger" style="display:none" id="candidatePAdd"></p> --}}

                    </div>
                    <div class="form-group mt-5 ml-2">
                        <label for="">
                            <h5>Current Address</h5>
                        </label>
                        <textarea name="candidate_current_address" id="candidate_current_address" cols="97" rows="" class="form-control ml-5"></textarea>

                    </div>

                </div>
                <div>
                    {{-- qulification fields --}}
                    <div>
                        <h4><b>Qualification : Certificate Available</b></h4>
                        <hr>
                    </div>
                    {{-- table formation for qualifications --}}
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                Level
                                            </th>
                                            <th class="text-center">
                                                Marks
                                                (%)
                                            </th>
                                            <th class="text-center">
                                                Institution Name
                                            </th>
                                            <th class="text-center">
                                                Medium(Hindi/English)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{--  --}}
                                        <tr>
                                            <td><b>10th</b></td>
                                            <td>
                                                <input type="number" name='candidate_10th_percentage' id="candidate_10th_percentage"
                                                    placeholder='Enter 10th Marks' class="form-control " />
                                                    {{-- <p class="text-danger" style="display:none" id="candidatetenth"></p> --}}

                                            </td>
                                            <td>
                                                <input type="text" name='candidate_10th_institution_name' id="candidate_10th_institution_name"
                                                    placeholder='Enter Institution Name' class="form-control " />
                                            </td>
                                            <td>
                                                <input type="text" name='candidate_10th_medium' id="candidate_10th_medium"
                                                    placeholder='Enter Medium(Hindi/English)' class="form-control " />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>12th</b>
                                                <label for=""><strong>(Subject)</strong></label>
                                                <select name="candidate_12th_subject" id="candidate_12th_subject" class="form-control ">
                                                    <option value="">--Select Any One--</option>
                                                    <option value="Science">Science</option>
                                                    <option value="Commerce">Commerce</option>
                                                    <option value="Arts">Arts</option>
                                                </select>

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="number" id="candidate_12th_percentage" name='candidate_12th_percentage'
                                                    placeholder='Enter 12th Marks' class="form-control " />

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="text" name='candidate_12th_institution_name' id="candidate_12th_institution_name"
                                                    placeholder='Enter Institution Name' class="form-control " />

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="text" name='candidate_12th_medium' id="candidate_12th_medium"
                                                    placeholder='Enter Medium(Hindi/English)' class="form-control " />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Graduation</b>
                                                <input type="text" class="form-control" id="graduation_degree_name"
                                                    placeholder="Enter Graduation Degree Name"
                                                    name="graduation_degree_name">

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="number" name='graduation_percentage' id="graduation_percentage"
                                                    placeholder='Enter Aggregate percentage' class="form-control " />

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="text" name='graduation_institution_name' id="graduation_institution_name"
                                                    placeholder='Enter Institution Name' class="form-control " />

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="text" name='graduation_medium' id="graduation_medium"
                                                    placeholder='Enter Medium(Hindi/English)' class="form-control " />

                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>PG/Deploma</b>
                                                <input type="text" class="form-control " id="pg_deploma_degree_name"
                                                    placeholder="Enter PG/Deploma Degree Name"
                                                    name="pg_deploma_degree_name">

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="number" name='pg_deploma_percentage' id="pg_deploma_percentage"
                                                    placeholder='Enter Aggregate percentage' class="form-control " />

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="text" name='pg_deploma_institution_name' id="pg_deploma_institution_name"
                                                    placeholder='Enter Institution Name' class="form-control " />

                                            </td>
                                            <td>
                                                <label for=""></label>
                                                <input type="text" name='pg_deploma_medium' id="pg_deploma_medium"
                                                    placeholder='Enter Medium(Hindi/English)' class="form-control " />

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- end table formation for qualifications --}}
                        <div class="form-inline mt-3">
                            <div class="form-group">
                                <label for=""><b>Reference (if any)</b></label>
                                <input type="text" class="form-control ml-4 " id="refrence_person_name" placeholder="Reference Person Name"
                                    name="refrence_person_name">
                            </div>
                            <div class="form-group">
                                <label for="" class="ml-5"><b>Ready To Go Outside Bikaner</b></label>
                                <select name="ready_to_go_outside_bikaner" id="ready_to_go_outside_bikaner"  class="form-control ml-4">
                                    <option value="">--Select Any One--</option>
                                    <option value="Yes Full Time">Yes Full Time</option>
                                    <option value="Yes Tour basis">Yes Tour basis</option>
                                    <option value="No But Urgent Only">No But Urgent Only</option>
                                    <option value="Not Possible">Not Possible</option>
                                </select>
                            </div>
                            <div class="form-group mt-4">
                                <label for=""><b>Earlier Tour & Travelling Done (if yes where)</b></label>
                                <textarea name="earlier_tour" id="earlier_tour" cols="90" rows="" class="form-control ml-4"></textarea>
                            </div>
                            <div class="form-group mt-4">
                                <label for=""><b>Have Driving License ?</b></label>
                                <label for="licenseyes" class="ml-5">Yes</label>
                                <input type="radio" name="license_ask" id="licenseyes" class="ml-3 " value="Yes">
                                <label for="licenseno" class="ml-3">No</label>
                                <input type="radio" name="license_ask" id="licenseno" class="ml-3" value="No">
                            </div>
                            <div class="form-group mt-4 ml-5">
                                <label for=""><b>Have PAN Card ?</b></label>
                                <label for="panyes" class="ml-5">Yes</label>
                                <input type="radio" name="pancard_ask" id="panyes" class="ml-3" value="Yes">
                                <label for="panno" class="ml-3">No</label>
                                <input type="radio" name="pancard_ask" id="panno" class="ml-3" value="No">
                            </div>
                            <div class="form-group mt-4">
                                <label for=""><b>Soft Skills ( Please Select if any )</b></label>
                                <label for="english" class="ml-3">English typing</label>
                                <input type="checkbox" class="ml-1" id="english" name="soft_skill[]"
                                    value="English typing">
                                <label for="hindi" class="ml-3">Hindi Typing</label>
                                <input type="checkbox" name="soft_skill[]" id="hindi" class="ml-1"
                                    value="Hindi Typing">
                                <label for="englishspeaking" class="ml-3">English Speaking</label>
                                <input type="checkbox" name="soft_skill[]" id="englishspeaking" class="ml-1"
                                    value="English Speaking">
                                <label for="englishwriting" class="ml-3">English Writing</label>
                                <input type="checkbox" name="soft_skill[]" id="englishwriting" class="ml-1"
                                    value="English Writing">
                                <label for="computerknowledge" class="ml-3">Basic Computer Knowledge</label>
                                <input type="checkbox" name="soft_skill[]" id="computerknowledge" class="ml-1"
                                    value="Basic Computer Knowledge">
                                <label for="bikeriding" class="ml-3">Bike Riding</label>
                                <input type="checkbox" name="soft_skill[]" id="bikeriding" class="ml-1"
                                    value="Bike Riding">
                                <label for="cardriving"class="ml-3">Car Driving</label>
                                <input type="checkbox" name="soft_skill[]" id="cardriving" class="ml-1"
                                    value="Car Driving">
                            </div>
                        </div>
                    </div>
                    {{-- work experience start div --}}
                    <div class="mt-5">
                        <div>
                            <h4><b>Work Experience</b></h4>
                            <hr>
                        </div>
                        {{-- experience dynamic table --}}
                        <div class="container">
                            <div class="row clearfix">
                                <div class="col-md-12 column">
                                    <table class="table table-bordered table-hover" id="tab_logic">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    S.No
                                                </th>
                                                <th class="text-center">
                                                    Company Name
                                                </th>
                                                <th class="text-center">
                                                    Work Done
                                                </th>
                                                <th class="text-center">
                                                    Salary Per Month
                                                </th>
                                                <th class="text-center">
                                                    Cheque/Cash
                                                </th>
                                                <th class="text-center">
                                                    Full/Part Time
                                                </th>
                                                <th class="text-center">
                                                    Reason For Leaving
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id='addr0'>
                                                <td>1</td>
                                                <td>
                                                    <input type="text" name='company_name[]'
                                                        placeholder='Enter Full Name' class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name='working_as[]'
                                                        placeholder='Work experience' class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name='salary_per_month[]'
                                                        placeholder='Enter Mobile' class="form-control" />
                                                </td>
                                                <td>
                                                    <div>
                                                        <label for="cheque">Cheque</label>
                                                        <input type="checkbox" name='cheque_or_cash[]' value="cheque"
                                                            onclick="cheque_cash_status(0)" class="cheque_cash_0" />
                                                    </div>
                                                    <div>
                                                        <label for="cash">Cash</label>
                                                        <input type="checkbox" class="ml-3 cheque_cash_0"
                                                            name='cheque_or_cash[]' value="cash"
                                                            onclick="cheque_cash_status(0)" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label for="fulltime">Full Time</label>
                                                        <input type="checkbox" name='parttime_fulltime[]' id="fulltime"
                                                            value="full-time" class="full_part_0"
                                                            onclick="full_part_status(0)" />
                                                    </div>
                                                    <div>
                                                        <label for="parttime">Part Time</label>
                                                        <input type="checkbox" name='parttime_fulltime[]'id="parttime"
                                                            value="part-time" class="full_part_0"
                                                            onclick="full_part_status(0)" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name='reason_for_leaving[]'
                                                        placeholder='Reason For Leaving' class="form-control" />
                                                </td>
                                            </tr>
                                            <tr id='addr1'></tr>
                                            {{-- ----------------- --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <span id="add_row" class="btn btn-primary pull-left">Add More</span><span id='delete_row'
                                class="pull-right btn btn-primary float-right">Delete Last</span>
                            <div class="form-inline mt-4">
                                <div class="form-group">
                                    <label for="" class="mr-4"><b>Special Knowledge (if any) :</b></label>
                                    <textarea name="special_knowledge" id="" cols="100" rows="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- end experience dynamic table --}}
                    </div>
                    {{-- work experience end div --}}
                    {{-- -----------Family Background------------------------- --}}
                    <div class="mt-5">
                        {{-- <div>
                            <h4><b>Family Background</b></h4>
                            <hr>
                        </div> --}}

                        <div class="container">
                            {{-- <div class="row clearfix">
                                <div class="col-md-12 column">
                                    <table class="table table-bordered table-hover" id="tab_logic">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    Name
                                                </th>
                                                <th class="text-center">
                                                    Relation
                                                </th>
                                                <th class="text-center">
                                                    Married(Yes/No)
                                                </th>
                                                <th class="text-center">
                                                    Age
                                                </th>
                                                <th class="text-center">
                                                    Occupation
                                                </th>
                                                <th class="text-center">
                                                    Health Condition
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="add_tr">
                                            <tr>
                                                <td>
                                                    <input type="text" name='relative_name[]'
                                                        placeholder='Enter Realtive Name' class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name="relation_from_candidate[]" value="Father"
                                                        readonly size="10px" value="father" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name='marriage_status[]' placeholder='****'
                                                        class="form-control" readonly value="yes" />
                                                </td>
                                                <td>
                                                    <input type="number" name="relative_age[]" class="form-control"
                                                        placeholder="Enter Relative Age">
                                                </td>
                                                <td>
                                                    <input type="text" name="relative_occupation[]"
                                                        class="form-control" placeholder="Enter Relative Occupation">
                                                </td>
                                                <td>
                                                    <input type="text" name='relative_health_condition[]'
                                                        placeholder='Relative Health Condition' class="form-control" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name='relative_name[]'
                                                        placeholder='Enter Realtive Name' class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name="relation_from_candidate[]" value="Mother"
                                                        readonly size="10px" value="mother" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name='marriage_status[]' placeholder='****'
                                                        class="form-control" readonly size="10px" value="yes" />
                                                </td>
                                                <td>
                                                    <input type="number" name="relative_age[]" class="form-control"
                                                        placeholder="Enter Relative Age">
                                                </td>
                                                <td>
                                                    <input type="text" name="relative_occupation[]"
                                                        class="form-control" placeholder="Enter Relative Occupation">
                                                </td>
                                                <td>
                                                    <input type="text" name='relative_health_condition[]'
                                                        placeholder='Relative Health Condition' class="form-control" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name='relative_name[]'
                                                        placeholder='Enter Realtive Name' class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name="relation_from_candidate[]"
                                                        value="Brother" readonly size="10px" value="brother"
                                                        class="form-control">
                                                </td>
                                                <td>
                                                    <div>
                                                        <label for="broyes" class="ml-3">Yes</label>
                                                        <input type="checkbox" name="marriage_status[]" value="Yes"
                                                            id="broyes" class="status_-2"
                                                            onclick="marriage_status_changes(-2)">
                                                        <label for="brono" class="ml-4">No</label>
                                                        <input type="checkbox" name="marriage_status[]" value="No"
                                                            id="brono" class="status_-2"
                                                            onclick="marriage_status_changes(-2)">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" name="relative_age[]" class="form-control"
                                                        placeholder="Enter Relative Age">
                                                </td>
                                                <td>
                                                    <input type="text" name="relative_occupation[]"
                                                        class="form-control" placeholder="Enter Relative Occupation">
                                                </td>
                                                <td>
                                                    <input type="text" name='relative_health_condition[]'
                                                        placeholder='Relative Health Condition' class="form-control" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" name='relative_name[]'
                                                        placeholder='Enter Realtive Name' class="form-control" />
                                                </td>
                                                <td>
                                                    <input type="text" name="relation_from_candidate[]" value="Sister"
                                                        readonly size="10px" class="form-control">
                                                </td>
                                                <td>
                                                    <div>
                                                        <label for="sisyes" class="ml-3">Yes</label>
                                                        <input type="checkbox" name="marriage_status[]" value="Yes"
                                                            id="sisyes" class="status_-1"
                                                            onclick="marriage_status_changes(-1)">
                                                        <label for="sisno" class="ml-4">No</label>
                                                        <input type="checkbox" name="marriage_status[]" value="No"
                                                            id="sisno" class="status_-1"
                                                            onclick="marriage_status_changes(-1)">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" name="relative_age[]" class="form-control"
                                                        placeholder="Enter Relative Age">
                                                </td>
                                                <td>
                                                    <input type="text" name="relative_occupation[]"
                                                        class="form-control" placeholder="Enter Relative Occupation">
                                                </td>
                                                <td>
                                                    <input type="text" name='relative_health_condition[]'
                                                        placeholder='Relative Health Condition' class="form-control" />
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <span id="add_new_row" class="btn btn-primary pull-left"
                                onclick="marriage_check_status(2)">Add More</span>
                            <span id='delete_last_relative_row' class="pull-right btn btn-primary float-right">Delete
                                Last</span> --}}
                            <div class="form-inline mt-4">
                                <div class="form-group">
                                    <label for="" class="mr-4"><b>Medical Problem (if any) :</b></label>
                                    <textarea name="medical_problem" id="" cols="100" rows="" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-inline mt-4">
                                <div class="form-group mt-4">
                                    <label for=""><b>Any Habits :</b></label>
                                    <label for="smoking" class="ml-3">Smoking</label>
                                    <input type="checkbox" class="ml-1" id="smoking" value="smoking"
                                        name="habits[]">
                                    <label for="drink" class="ml-3">Drink</label>
                                    <input type="checkbox" id="drink" class="ml-1" name="habits[]"
                                        value="drink">
                                    <label for="nonveg" class="ml-3">Non Veg.</label>
                                    <input type="checkbox" id="nonveg" class="ml-1" name="habits[]"
                                        value="nonveg">
                                </div>
                                <div class="form-group mt-4">
                                    <label for="" class="ml-5"><b>Expectation :</b></label>
                                    <b class="ml-2">Rs</b><input type="text" class="form-control ml-3"
                                        placeholder="Enter Expected Amount" name="expected_amount" id="expected_amount"><b class="ml-2">Per
                                        Month</b>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="" class="ml-5"><b>Department :</b></label>
                                   <select class="form-select ml-3 form-control" name="department_id" id="departmentunique_id">
                                            <option value="">Select Department</option>
                                            @foreach ($department as $item)
                                                <option value="{{$item->id}}">{{$item->department_name}}</option>
                                            @endforeach
                                   </select>
                                </div>

                            </div>

                            {{-- <div class="form-group mt-4">
                                <label for=""><b>Signature</b></label>

                                <div id="signature-pad" class="m-signature-pad">
                                    <div class="m-signature-pad--body">
                                        <canvas></canvas>
                                        <input type="hidden" name="signature" id="signature" value="">
                                        <input type="button" onclick="clearpad()" class="btn btn-primary"
                                            value="Reset">
                                    </div>
                                </div>
                            </div> --}}



                            <div class="form-group mt-4 float-right mr-4">
                                <label for="" class="ml-5"><b>Date</b></label>
                                <input type="date" class="form-control ml-4" name="date"
                                    value="@php echo date('Y-m-d') @endphp">
                            </div>
                        </div>
                    </div>
                    {{-- end Family Background- dynamic table --}}
                </div>
                {{-- Family Background  end div --}}
                <div class="form-group text-center mt-5 ml-5">
                    <button type="button" class="btn btn-success" onclick="submitForm(event)"  id="subint" name="submit0" data-target="#testModal" validationcheck='1'>Submit</button>
                </div>
            </form>
        </div>
    </div>
    {{-- form end --}}
    {{-- add one more same row for experience  --}}
    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                //   cash_cheque_statement
                $('#addr' + i).find('td:nth-child(5)').find('input').attr('class', 'cheque_cash_' + i);
                $('#addr' + i).find('td:nth-child(5)').find('input').attr('onclick', 'cheque_cash_status(' +
                    i + ')');
                //   full time part time statemenet
                $('#addr' + i).find('td:nth-child(6)').find('input').attr('class', 'full_part_' + i);
                $('#addr' + i).find('td:nth-child(6)').find('input').attr('onclick', 'full_part_status(' +
                    i + ')');
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                //  console.log(i);
                //   $('.cheque_cash_0').attr('class','cheque_cash_'+(i));
                i++;
                //   kl dhekege
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
            });
        });
        // add more in relatives
        $(document).ready(function() {
            var tr_id = 0;
            $("#add_new_row").click(function() {
                var html = " <tr id='addrelative_" + tr_id + "'><td><input type='text' name='relative_name[]' \
                             placeholder='Enter Realtive Name' class='form-control'/></td>\
                    <td><input type='text' name='relation_from_candidate[]' class='form-control'></td>\
                    <td>\
                        <div><label for='' class='ml-3'>Yes</label><input type='checkbox' name='marriage_status[]'\
                             value='Yes' class='status_" + tr_id + " ml-1' onclick='marriage_status_changes(" + tr_id + ")'>\
                             <label for='' class='ml-4'>No</label><input type='checkbox' \
                             name='marriage_status[]'' value='No' class='status_" + tr_id +
                    " ml-1' onclick='marriage_status_changes(" + tr_id + ")'></div></td>\
                    <td><input type='text' name='relative_age[]' class='form-control'></td>\
                    <td><input type='text' name='relative_occupation[]' class='form-control'></td>\
                    <td><input type='text' name='relative_health_condition[]' class='form-control'></td></tr>";
                $('#add_tr').append(html);
                tr_id++;
            })
            $('#delete_last_relative_row').click(function() {
                tr_id--;
                $('#addrelative_' + tr_id).remove();
            })
        })
        //   marriage status check
        function marriage_status_changes(clss_id) {
            console.log("status_" + clss_id);
            $(".status_" + clss_id).change(function() {
                $(".status_" + clss_id).prop('checked', false);
                $(this).prop('checked', true);
            });
        }
        //  end marriage status check
        // cheque cash status check
        function cheque_cash_status(cheque_cash_id) {
            // console.log("hello");
            $(".cheque_cash_" + cheque_cash_id).change(function() {
                $(".cheque_cash_" + cheque_cash_id).prop('checked', false);
                $(this).prop('checked', true);
            });
        }

        function full_part_status(full_part_id) {
            console.log(full_part_id);
            $(".full_part_" + full_part_id).change(function() {
                $(".full_part_" + full_part_id).prop('checked', false);
                $(this).prop('checked', true);
            });
        }
        // end cheque cash status check

    </script>
   
    {{-- ---------------test model --}}

    {{-- <div class="modal fade" id="testModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content rounded">
                <div class="modal-header alert alert-secondary h6 position-sticky">
                        <h4 class="text-center">General Aptitude Questions</h4>
                </div>        
                <div class="modal-body py-0 " style="height:850px;overflow-y:scroll;">
                    <div id="success_message_id">
                    </div>
                    <form  method="post" class="examsubmit">
                        
                    <div id="all_question_show">
                        
                    </div>
                    <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="examsubmit()" id="examid">Submit</button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div> --}}
@endsection
