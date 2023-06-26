@extends('layouts.app')
@section('content')



<form action="{{url('questions')}}" class="multiple_record" id="form1" method="post">
    @csrf
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
    <div class="col-lg-6 col-md-12 pb-3 ng-scope duplicate-row" id="question_div_0" data-value="2">
        <div class="card border-left border-lg rounded border-primary h-100 mt-5">
            <div class="card-body">
                <div class="form-group">
                    <textarea name="question[]" id="" cols="" rows="" placeholder="Enter Question" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <div class="customer_records" >
                        
                        <input  type="text" name="options_0[]" class="form-control w-75 d-inline-block mb-3" placeholder="option 1" required id="question_0_option_1">
                        <input type="radio" name="correct_answer_0" value="1" required class="m-1">
                        
                        <input  type="text" name="options_0[]" class="form-control w-75 d-inline-block" placeholder="option 2" required id="question_0_option_2">
                        <input type="radio" name="correct_answer_0" value="2" required class="m-1">
                       
                        <div class="customer_records_dynamic mt-3" id="option_div_0"></div>
                        <a class="extra-fields-customer btn btn-primary mt-3" onclick="add_inputs(0)">Add More</a>
                        {{-- <button class="btn btn-danger float-right btn-remove" onclick='deletediv(0)'><i class="fa fa-trash" aria-hidden="true"></i></button>  --}}
                    </div>   
                </div>     
            </div> 
        </div>    
    </div>
</div>
{{-- column dev end --}}
<div class="text-right mt-5">
    <button class="btn btn-success mr-2" id="btnid">Submit</button>
    <span class="btn btn-secondary mr-2" id="add_more_question" onclick="myfun()">Add More Question</span>
</div>
</form>
<script>
   
var count=2;
// const option_data = [];
    function add_inputs(id){
        // alert(count)
        var option_placeholder=$('#question_div_'+id).attr('data-value');
        option_placeholder++;
        // option_data.push(option_placeholder+1);
        // console.log(option_data);
        $('#question_div_'+id).attr('data-value',option_placeholder);
        // $('#hidden_id_0').val(option_data);
        count++;
        var html='';
        html='<div class="remove input-group-append mt-0"  id=question_div_'+id+'_'+count+' >\
  <input name="options_'+id+'[]" type="text" class="form-control w-75" placeholder="option '+parseInt(option_placeholder)+'" required id="question_'+id+'_option_'+count+'">\
  <input type="radio" name="correct_answer_'+id+'" value="'+parseInt(option_placeholder)+'" class="m-2" required  >\
  <a class="remove-field btn-remove-customer btn btn-danger mb-3"  onclick="remove('+count+','+id+')">Remove</a></div>';
$('#option_div_'+id).append(html);

// <a class="remove-field btn-remove-customer btn btn-danger mb-3" onclick="remove_inputs('+id+','+count+','+parseInt(option_placeholder)+')">Remove</a>
// console.log(option_placeholder);
}
// my experiment --------
/*function remove_inputs(question_div_id,ids,option_placeholder){
   
var option_count=$('input[name="options_'+question_div_id+'[]"]').length;
console.log('option_count=='+option_count);
console.log('option_placeholder=='+option_placeholder);
var data=$('input[name="options_'+question_div_id+'[]"]');

  for (let i=option_placeholder; i < option_count ;i++){
    
    var tag_id=$(data[i]).attr('id');
   
  $(`#${tag_id}`).next().val($(`#${tag_id}`).nextAll().val()-1);
    var placeholder=$(data[i]).attr('placeholder');
    
    var intger_val_of_placeholder=Number(placeholder.slice(-2));
   

    $(data[i]).attr('placeholder',`option ${intger_val_of_placeholder-1}`)
   
  }
  console.log(data);
    
    option_count=option_count-1;

        $('#question_div_'+question_div_id).attr('data-value', option_count);

        $('#question_div_'+question_div_id+'_'+ids).remove();
 
   
}
*/




function remove(option_id,question_id){

    // console.log(option_id);
    var option_length= $('#question_div_'+question_id).attr('data-value');
    

    for(let i=option_id; i<option_length;i++){
        
        $('#question_'+question_id+'_option_'+(i+1)).attr('placeholder',`option ${i}`);
      
        $('#question_'+question_id+'_option_'+(i+1)).next().val(i)
        $('#question_'+question_id+'_option_'+(i+1)).next().next().attr('onclick',`remove(${i},${question_id})`)
        $('#question_'+question_id+'_option_'+(i+1)).parent().attr('id',`question_div_${question_id}_${i}`)
        $('#question_'+question_id+'_option_'+(i+1)).attr('id',`question_${question_id}_option_${i}`)
        // console.log( $('#question_'+question_id+'_option_'+ (i+1)).html());
        
    }
    $('#question_div_'+question_id).attr('data-value', option_length-1);
    $('#question_div_'+question_id+'_'+option_id).remove();
count--;


}


</script>
<script>
    var counts=0;
    // var question_div=true;
    
function myfun(){
    count=2;
    counts++
        html='<div class="col-lg-6 col-md-12 pb-3 ng-scope duplicate-row" id="question_div_'+counts+'" data-value="2">\
            <div class="card border-left border-lg rounded border-primary h-100 mt-5">\
                <div class="card-body">\
                    <div class="form-group"><textarea name="question[]" id="" cols="" rows="" placeholder="Enter Question" class="form-control" required></textarea></div>\
                    <div  class="form-group">\
                        <div class="customer_records"><input  type="text" name="options_'+counts+'[]" class="form-control w-75 d-inline-block mb-3" placeholder="option 1" required>\
                            <input type="radio" name="correct_answer_'+counts+'" value="1" required>\
                            <input  type="text" name="options_'+counts+'[]" class="form-control w-75 d-inline-block" placeholder="option 2" required>\
                            <input type="radio" name="correct_answer_'+counts+'" value="2" required>\
                            <div class="customer_records_dynamic mt-3" id="option_div_'+counts+'"></div>\<a class="extra-fields-customer btn btn-primary mt-3"  onclick=add_inputs("'+counts+'") >Add More</a>\
                            <button class="btn btn-danger float-right btn-remove" onclick="deletediv('+counts+')"><i class="fa fa-trash" aria-hidden="true"></i></button> \
                        </div>\
                        </div>\
                    </div>\
                <\div>\
            </div>'
$('#main_row_div_0').append(html);
}  

function deletediv(delete_div_id){
    $('#question_div_'+delete_div_id).remove();
}
</script>

<script>
</script>  
@endsection


{{-- ------- --}}

{{-- //     const index = option_data.indexOf(option_placeholder);
//     if (index > -1) { // only splice array when item is found
//         option_data.splice(index, 1); // 2nd parameter means remove one item only
//     }
//     // console.log(`question_${question_div_id}_option_${option_placeholder}`);
//    var a= $(`#question_${question_div_id}_option_${option_placeholder}`).attr('placeholder');
//    var b=a.slice(-1);
//    b_number=Number(b)
   
//    console.log(option_data);
//     for(let i=0;i<option_data.length;i++){
//         // console.log(option_data[i]);
//         $(`#question_${question_div_id}_option_${option_data[i]}`).attr('placeholder',`option ${b_number+i}`);
//     }
    

//    a.slice(-1);
//    var b=a.slice(-1); --}}
{{-- // $(`#question_${question_div_id}_option_${option_placeholder}`).attr('placeholder',`option ${b_number+i}`);
// var next_element=$(`#question_${question_div_id}_option_${option_placeholder}`).next('input');
// console.log(next_element);
// var next_element=$(`#question_${question_div_id}_option_${option_placeholder}`).next('input')


// console.log(next_element);
// var next_element=data[i].next('input');
// console.log( next_element); --}}

{{-- // var option_lenght=option_data.length;
// for(var i=0;i<option_lenght;i++){
//     console.log(i);
    // $(`#question_${question_div_id}_option_${i+b}`).attr('placeholder',`option ${i-1}`);
    
// }


// ---- --}}