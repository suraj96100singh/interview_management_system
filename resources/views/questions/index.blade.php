@extends('layouts.app')
@section('content')
@include('header.head');
 {{-- -------------------------session alerts---- --}}
 @if(Session::has('msg'))
 <div class="col-md-12 ">
     <div class="alert alert-success toggle_class"><h4>{{Session::get('msg')}}</h4></div>
 </div>
 @endif
 <div class="col-md-12" id="delete_session_div">
    {{-- here delete session div will come from delete fucntion --}}
 </div>
{{-- ----------------------------------- --}}
<div class="row">
{{-- col 1 --}}
<div class="col-5"> 
@foreach ($question_count as $departmentval) 
    <div class="row d-flex" style="display: block">
        <div class="col-6 m-2" id="question_div_0" data-value="1">
            <div class="card ">
                <div class="card-body">
                    <th><b>{{ $departmentval->department_name }}</b></th>
                    <th >[<span id='question_count_{{ $departmentval->id }}'>{{ count($departmentval->questions) }}</span>]</th><hr> 
                    @if(count($departmentval->questions)>0)       
                    <th><a href=""  data-toggle="modal" data-target="" onclick="showdata({{ $departmentval->id }})" id="remove_link_{{ $departmentval->id }}">Click To Show Question & Answers</a></th>
                    @endif   
                </div>     
            </div> 
        </div>    
    </div> 
         @endforeach
        </div>
        <div class="col-7">
            <div class="col col-12 mt-2" id="show_questions" style="display:none">
                <div class="card">
                    {{-- <div class="mt-5 card-body"> --}}
                    <table  class="hidden" id="list_data">
                    </table>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
   
</div>
{{-- -----------------------------------edit form---- --}}
<div class="modal fade" id="questionModal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-right mw-950px modal-dialog-scrollable modal-lg">
            <!--begin::Modal content-->
        <div class="modal-content rounded">
                <!--begin::Modal header-->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="heading">Edit Question</h1>
                <i class="fa-solid fa-xmark fa-fade" class="btn-close" data-dismiss="modal" aria-label="Close"></i>
            </div>
               
            <div class="modal-body ">
                    {{-- ----------------------- --}}
                <form action="" class="multiple_record" id="form1" method="post">
                        {{-- row div begin --}}
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        {{-- <textarea name="questiosn" id="question_val" cols="" rows="" placeholder="Enter Question" class="form-control"></textarea> --}}
                        <input type="text" name="question" id="question_val" placeholder="Enter Question" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <div class="customer_records" >
                            {{-- <div id="kesehodost">
                                <input  type="text" name="options_0[]" class="form-control w-75" placeholder="option 1" id="">
                                <input type="radio" name="correct_answer_0" value="0">
                            </div> --}}
                                <div class="customer_records_dynamic mt-3" id="option_div_0">
                                   
                                
                                </div>
                                <div id="add_more">
                                    
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                
                                {{-- <a class="extra-fields-customer btn btn-primary mt-3" href="#" onclick="add_inputs(0)">Add More</a> --}}
                        </div>
                        
                    </div>     
                </div> 
                    
                    
                </form>
                  
                    
                    
                </div>
            </div>  
        </div>
    </div>
</div>

{{-- -------------------------edit Question--- --}}
<script>
  function show_edit_data(id){
    // console.log(id);
    
    $.ajax({
        type:'GET',
        url:'questions/'+id+'/edit',
        success: function(edit_res){
            // $('extra-fields-customer').html('');
            $('#option_div_0').html('');
            $('#add_more').html('');

            

            // console.log(edit_res.question_option.options[0].right_answer);
            $('#question_val').val(edit_res.question_option.Question);
            len=(edit_res.question_option.options).length;
            // console.log(len);
            count=1;
            for(let i=0;i<len;i++){
                count++;
                var right_ans=edit_res.question_option.options[i].right_answer;
                console.log(right_ans);
                var htm="<div id='selected_options_"+[i+1]+"'><input type='text' class='form-control w-75 mb-2 d-inline-block' name='options[]' value='"+edit_res.question_option.options[i].options+"' placeholder='option "+[i+1]+"' id='"+i+"' required>";
                    if(edit_res.question_option.options[i].right_answer==1)
                 htm+= "<input type='radio' name='correct_answer' value='"+[i+1]+"' checked >";
                 else
                 htm+="<input type='radio' name='correct_answer' value='"+[i+1]+"' >";
                htm+= "<a href='#'' class='remove-field btn-remove-customer btn btn-danger mb-3 d-inline' onclick='remove_inputs("+[i+1]+")'>Remove</a>\
                    </div>";
                $('#option_div_0').append(htm);
            }
            $('#add_more').append("<div class='d-inline'><a class='extra-fields-customer btn btn-primary mt-3' href='#'' onclick='add_inputs("+count+")'>Add More</a></div>")
            $('#form1').attr('action','questions/'+edit_res.question_option.id);
        }

    })

  }
//   ---Add more option------------------
var count=1;
function add_inputs(id){

    // console.log(count);
    html="<div id='selected_options_"+count+"'><input type='text' class='form-control w-75 mb-2 d-inline-block' name='options[]' value='' placeholder='option "+count+"' id='"+count+"' required>\
        <input type='radio' name='correct_answer' value='"+count+"'>\
        <a href='#'' class='remove-field btn-remove-customer btn btn-danger mb-3 d-inline' onclick='remove_inputs("+count+")'>Remove</a></div>"
        $('#option_div_0').append(html);
        count++;

}
function remove_inputs(ids){
    // console.log(ids);
    let num = document.getElementsByName("options[]").length;
    // console.log(num);
    // var option=document.getElementsByName("options[]");
    var opcount=ids;
    
    console.log(ids,num);

 
      $('#selected_options_'+ids).remove();
        for(var i=1;i<num;i++){
            console.log(i);
            $('#'+opcount).attr('placeholder','option '+i);
            opcount++;
        }
    count--;
}

//   ------show data

function showdata(id){
    console.log('hello');
    document.getElementById("show_questions").style.display='block';
    $.ajax({
        type:'GET',
        url:'questions',
        data:{'id':id},
        success: function(res){
        $('#list_data').html('');

            if(res.all_questions.questions){
                var question = "";
                var index=1;
                question+="<ol>";
                
                res.all_questions.questions.forEach(elements => {
                    // console.log(elements);
                    
                    question+='('+index+').';
                    question += "<li class='d-inline'>"+elements.Question+"</li>"+"<span  data-toggle='modal'  data-target='#questionModal' onclick='show_edit_data("+elements.id+")'> <i class='fa fa-edit ml-3' aria-hidden='true'></i>"+"</span>"+"<span  onclick='show_delete_data("+elements.id+")' data-token="+'{{ csrf_token() }}'+" id='delete_btn_"+elements.id+"'><i class='fa fa-trash ml-3' aria-hidden='true'></i>"+"</span>"
                    question+="<ol type='a'>"
                    elements.options.forEach(element_option => { 
                    question += element_option.right_answer?"<li class='text-success'>"+element_option.options+"</li>":"<li class='text-danger'>"+element_option.options+"</li>";
                    
                    });  
                    question+="</ol>";
                    index++
                });  
            }
            question+="</ol>";
        $('#list_data').append(question);
    
        },            
    });
}

function show_delete_data(ids){
    // console.log(ids);
    if(!confirm('Do You Really Want To Perform This Action')){
        $("#delete_btn_"+ids).preventDefault();

    }
    var token = $("#delete_btn_"+ids).data("token");
    // console.log(token);
    $.ajax({
        url:'questions/'+ids,
        type:'Delete',
        data:{
            "_method": 'DELETE',
            "_token": token,
        },
        success:function (res) {
        //    console.log(res);
        // location.reload();
        showdata(res.department_id)
            var value=$('#question_count_'+res.department_id).text();
            // var value=document.getElementById("question_count_"+res.department_id).innerText;
            // console.log(value);
            // console.log(value-1);
            //  82
            if(value==1){
                $('#remove_link_'+res.department_id).remove()
                $('#show_questions').css({
                    'display':'none'
                });
            }
            $('#question_count_'+res.department_id).text(value-1);
            $('#delete_session_div').append("<div class='alert alert-danger toggle_class' id='toggle_session'><h4 class='delete_div'></h4></div>");
            $('.delete_div').html(res.errormsg);
            $('#toggle_session').toggle(2000);
            setInterval(() => {
            $('#toggle_session').remove();
            }, 2000);

           






         

         }


    })

}
$(document).ready(function(){
  $('.toggle_class').toggle(3000);
});
</script>



{{-- ------------------------- --}}

@endsection