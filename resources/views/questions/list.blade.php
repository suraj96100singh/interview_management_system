@extends('layouts.app')
@section('content')
@include('header.head')
{{-- <div class="float-right mt-2">
    <button class="btn btn-secondary mr-2" id="add_more_question" onclick="myfun()">Add More Question</button>
</div> --}}

<form action="{{url('questions')}}" class="multiple_record" id="form1" method="post">
    {{-- row div begin --}}
    @csrf
    {{-- <div class="float-right mt-2">
        <button class="btn btn-secondary mr-2" id="btnid">Submit</button>
    </div> --}}
    <div class="form-group m-2">
        <label for=""><b>Select Department</b></label>
        <select name="selected_department" id="" class="form-control w-25" required>
            <option value="">--Select any One--</option>
            @foreach ($department as $departmentval)
            <option value="{{ $departmentval->id }}">{{ $departmentval->department_name }}</option>
            @endforeach
        </select>
    </div>
<div  id="main_row_div_0" class="row">
{{-- column div begin --}}
    <div class="col-lg-6 col-md-12 pb-3 ng-scope duplicate-row" id="question_div_0" data-value="1">
        <div class="card border-left border-lg rounded border-primary h-100 mt-5">
            <div class="card-body">
                <div class="form-group">
                    <textarea name="question[]" id="" cols="" rows="" placeholder="Enter Question" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <div class="customer_records" >
                        
                        <input  type="text" name="options_0[]" class="form-control w-75 d-inline-block" placeholder="option 1" required>
                        <input type="radio" name="correct_answer_0" value="0" required>
                        <div class="customer_records_dynamic mt-3" id="option_div_0"></div>
                        <a class="extra-fields-customer btn btn-primary mt-3" onclick="add_inputs(0)">Add More</a>
                        <button class="btn btn-danger float-right btn-remove" onclick='deletediv(0)'><i class="fa fa-trash" aria-hidden="true"></i></button> 
                    </div>   
                </div>     
            </div> 
        </div>    
    </div>
</div>
<div class="text-right mt-5">
    <button class="btn btn-success mr-2" id="btnid">Submit</button>
    <span class="btn btn-secondary mr-2" id="add_more_question" onclick="myfun()">Add More Question</span>
</div>
</form>
<script>
var count=1;
    function add_inputs(id){
        var option_placeholder=$('#question_div_'+id).attr('data-value');
        option_placeholder++;
        $('#question_div_'+id).attr('data-value',option_placeholder);
        count++;
        var html='';
        html='<div class="remove input-group-append mt-0"  id=question_div_'+id+'_'+count+' >\
  <input name="options_'+id+'[]" type="text" class="form-control w-75" placeholder="option '+option_placeholder+'" required>\
  <input type="radio" name="correct_answer_'+id+'" value="'+(option_placeholder-1)+'" class="d-inline" required>\
  <a class="remove-field btn-remove-customer btn btn-danger mb-3" onclick="remove_inputs('+id+','+count+','+option_placeholder+')">Remove</a></div>';
$('#option_div_'+id).append(html);
// console.log(option_placeholder);
}
function remove_inputs(question_div_id,ids,option_placeholder){
        option_placeholder--;
        $('#question_div_'+question_div_id).attr('data-value',option_placeholder);
        $('#question_div_'+question_div_id+'_'+ids).remove();
        // option_placeholder=1;
        // console.log(option_placeholder);    
}
</script>
<script>
    var counts=0;
    // var question_div=true;
    
function myfun(){
    counts++
        html='<div class="col-lg-6 col-md-12 pb-3 ng-scope duplicate-row" id="question_div_'+counts+'" data-value="1">\
            <div class="card border-left border-lg rounded border-primary h-100 mt-5">\
                <div class="card-body">\
                    <div class="form-group"><textarea name="question[]" id="" cols="" rows="" placeholder="Enter Question" class="form-control" required></textarea></div>\
                    <div  class="form-group">\
                        <div class="customer_records"><input  type="text" name="options_'+counts+'[]" class="form-control w-75 d-inline-block" placeholder="option 1" required>\
                            <input type="radio" name="correct_answer_'+counts+'" value="0" required>\
                            <div class="customer_records_dynamic mt-3" id="option_div_'+counts+'"></div>\<a class="extra-fields-customer btn btn-primary mt-3"  onclick=add_inputs("'+counts+'") >Add More</a>\
                            <button class="btn btn-danger float-right btn-remove" onclick="deletediv('+counts+')"><i class="fa fa-trash" aria-hidden="true"></i></button> \
                        </div>\
                        </div>\
                    </div>\
                <\div>\
            </div>'
$('#main_row_div_0').append(html);
}  

// function all_option(option_id){
//     // console.log(option_id);
//     let elements = document.getElementById("correct_answer_"+option_id+"[]").defaultValue='1';
//     document.getElementsByName("correct_answer_"+option_id+"[]").value=elements;
//     // console.log(elements);
// }
function deletediv(delete_div_id){
    $('#question_div_'+delete_div_id).remove();
}
</script>
{{-- ------------------------------- --}}

<script>
</script>  
@endsection