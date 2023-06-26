
@section('content')
@extends('layouts.app');

{{-- ------------------------ --}}
{{-- practical --}}
<div class="modal fade" id="departmentModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px modal-dialog-scrollable modal-lg">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="heading">Add Department</h1>
                {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark fa-fade"></i></button> --}}
                <i class="fa-solid fa-xmark fa-fade" class="btn-close" data-dismiss="modal" aria-label="Close" onclick="refresh()"></i>
              </div>        
            <!--begin::Modal body-->
            {{-- -----------------------below use for success message----- --}}
            <div class="modal-body ">
                {{-- ---------------------------------------- show page --}}
               <div id="success_message_id">

               </div>

                                <div class="card-body">  
                                          <form  method="post" enctype="multipart/form-data" id="table-container" action="{{url('categories')}}">
                                            {{-- action="{{url('categories')}}" --}}
                                            <input type="hidden" name="_method" value="" id="putmethod">
                                            @csrf
                                            {{-- @if(isset($items))
                                            @method('PUT')
                                            @endif --}}
                                                
                                          
                                              
                                            {{-- @method('PUT'); --}}
                                              <div class="form-group">
                                                <ul id="savefrom_list"></ul>
                                                    <label for="Department_Name"><b>Department Name</b></label>
                                                    <span class="text-danger">*</span>
                                                    <input class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Name')?'is-invalid':''}}" value="{{old('Department_Name')}}" id="edit_Department_Name" type="text" name="Department_Name" placeholder="Enter Department Name" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                                                    @if($errors->any())
                                                    <p class="invalid-feedback">{{$errors->first('Department_Name')}}</p>
                                                    @endif
                                                  </div> 
                                                <div class="form-group">
                                                  <label for="Head_of_Department"><b>HOD</b></label>
                                                  <span class="text-danger">*</span>
                                                  <select name="Head_of_Department" id="edit_hod" class="form-control rounded-pill {{$errors->any() && $errors->first('Head_of_Department')?'is-invalid':''}}" required>
                                                    @if($errors->any())
                                                    <p class="invalid-feedback">{{$errors->first('Head_of_Department')}}</p>
                                                    @endif
                                                    <option value="" id="select_any_one">--Select Any User--</option>
                                                
                                                    @foreach ($items as $username)
                                                    <option value="{{ $username->id??" " }}">{{ $username->name??" " }}</option>
                                                    @endforeach
                                                    
                                                  </select>
                                                  @if($errors->any())
                                                  <p class="invalid-feedback">{{$errors->first('Head_of_Department')}}</p>
                                                  @endif
                                                  
                                                </div>
                                                <div class="form-group">
                                                  <label for="Department_Email"><b>Email</b></label>
                                                  <span class="text-danger">*</span>
                                                  <input class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Email')?'is-invalid':''}}" value="{{old('Department_Email')}}" id="edit_Department_Email" type="email" name="Department_Email" placeholder="Enter Email" required>
                                                  @if($errors->any())
                                                    <p class="invalid-feedback">{{$errors->first('Department_Email')}}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                  <label for="Department_Phone_Number"><b>Phone Number</b></label>
                                                  <span class="text-danger">*</span>
                                                  <input class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Phone_Number')?'is-invalid':''}}" value="{{old('Department_Phone_Number')}}" id="edit_Department_Phone_Number" type="number" name="Department_Phone_Number" placeholder="Enter phone Number" required>
                                                  @if($errors->any())
                                                  <p class="invalid-feedback">{{$errors->first('Department_Phone_Number')}}</p>
                                                  @endif
                                                </div>
                                                <div class="form-group">
                                                  <label for="Department_Address"><b>Address</b></label>
                                                
                                                  <textarea name="Department_Address" id="edit_Department_Address" cols="" rows="" class="form-control rounded-pill" placeholder="Enter Department Address" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                  <label for="shift_start_time"><b>Shift Start</b></label>
                                                 
                                                  <input type="time" name="shift_start_time" class="form-control" id="edit_shift_start_time" value="" required>
                  
                                                  <label for="Total_Number_Employee"><b>Shift End</b></label>
                                                  
                                                  <input type="time" name="shift_end_time" class="form-control" id="edit_shift_end_time" value="" onchange="diffrence()" required>
                                                  <label for="Department_Working_Hours" ><b>Workings Hours</b></label>
                                                 
                                                  <input type="text" name="Department_Working_Hours" class="form-control {{$errors->any() && $errors->first('Department_Working_Hours')?'is-invalid':''}}" placeholder="Hours"  id="edit_Department_Working_Hours"   value="{{old('Department_Working_Hours')}}" required>
                                                  @if($errors->any())
                                                  <p class="invalid-feedback">{{$errors->first('Department_Working_Hours')}}</p>
                                                  @endif
                                                </div>
                                                <div class="form-group">
                                                  
                                                </div>
                                                <div class="form-group">
                                                  <label for="check1" ><b>Department Status</b></label>
                                                  <div class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Status')?'is-invalid':''}}" >
                                                  <label for="edit_check1">Active</label>
                                                      <input type="radio" name='Department_Status' id="edit_check1" value="Active" required>
                                                  <label for="Edit_check2">Inactive</label>
                                                      <input type="radio" name='Department_Status' value="Inactive" id="edit_check2">
                                                      
                                                    </div>
                                                    @if($errors->any())
                                                  <p class="invalid-feedback">{{$errors->first('Department_Status')}}</p>
                                                  @endif
                                                </div>
                                                <div class="form-group">
                                                  <label for="Department_Image"><b>Upload Image</b></label>
                                                  <span class="text-danger">*</span>
                                                  <input class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Image')?'is-invalid':''}}"  type="file" name="Department_Image" id="Department_Image">
                                                  {{-- <input type="text" value="" id="department_image" disabled name="Department_Image"> --}}
                                                  <img src="" alt="" class="src" style="border-radius: 50%; width: 100px" id="src">
                                                  <input type="hidden" value="" id="Department_Images" name="Department_Image">
                                                  
                                                  
                                                  
                                                  @if($errors->any())
                                                  <p class="invalid-feedback">{{$errors->first('Department_Image')}}</p>
                                                  @endif

                                                </div>
                                                
                                                {{-- <div class="text-center">
                                                    <input type="submit" class="btn btn-success" id="submit" value="Submit">
                                                {{-- <button class="btn btn-success" id="submit">submit</button> --}}
                                                {{-- </div> --}}
                                                <div class="text-center mt-5">
                                                    <button type="submit" name="submitbtn" class="btn btn-primary submit" id="submit">Submit</button>
                                                    <button type="button" data-dismiss="modal" class="btn border border-dark" onclick="refresh()">Cancel</button>
                        
                                                </div>
                                               </form>       
                              </div>
                         
                  <script>
                  function diffrence(){
                  var start = document.getElementById("edit_shift_start_time").value;
                  var end = document.getElementById("edit_shift_end_time").value;
                  function diff(start,end){
                      start = start.split(":");
                      end = end.split(":");
                      var startDate = new Date(0, 0, 0, start[0], start[1], 0);
                      var endDate = new Date(0, 0, 0, end[0], end[1], 0);
                      var diff = endDate.getTime() - startDate.getTime();
                      var hours = Math.floor(diff / 1000 / 60 / 60);
                      diff -= hours * 1000 * 60 * 60;
                      var minutes = Math.floor(diff / 1000 / 60);
                     
                      
                      return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
                  }
                  // console.log(diff());
                  document.getElementById("edit_Department_Working_Hours").value = diff(start , end);
                  }
                  </script>
                
            </div>
        </div>
    </div>
</div>
{{-- <script type="text/javascript">
  @if(count($errors) > 0)
      $('#departmentModal').modal('show');
  @endif
  </script> --}}



{{-- -------------index form------------------------------------------------- --}}
<div class="container-fluid">
    <div class="alert alert-primary h4 ">
      Department Records
        
        {{-- <div style="text-align:right"> --}}
            <a href="{{route('categories.create')}}" class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#departmentModal" id="edit_department" onclick="resetform()">Add Department</a>

            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#departmentModal">Add Department +</button> --}}
            
        {{-- </div> --}}
        

    </div>
    {{-- -------------------------session alerts---- --}}
    @if(Session::has('msg'))
        <div class="col-md-12 ">
            <div class="alert alert-success toggle_class"><h4>{{Session::get('msg')}}</h4></div>
        </div>
        @endif
        @if(Session::has('errormsg'))
        <div class="col-md-12">
            <div class="alert alert-danger toggle_class"><h4>{{Session::get('errormsg')}}</h4></div>
        </div>
        @endif
    {{-- ----------------------------------- --}}


<div class="table-responsive">
    <table class="table table-striped table-success table-hover tbl">
        <thead class="bg-dark text-white">
          
        <tr>
            <th>S.No</th>
            <th>Department Name</th>
            <th>HOD</th>
            <th>Department Email</th>
            <th>Department Phone Number</th>
            <th>Department Address</th>
            <th>Department Working Hours</th>
            <th>Shift Start Time</th>
            <th>Shift End Time</th>
            <th>Department Image</th>
            <th>Department Status</th>
            <th  class="text-center">Edit</th>
            <th  class="text-center">delete</th>
        </tr>
        
    </thead>
    <tbody class="table-hover">
    @if(count($department_data)>0)
      {{-- @dd(count($department_data)) --}}

      @foreach ($department_data as $department_val)
      {{-- @dd($department_val) --}}

      
      
        <tr>
            <td>{{ $loop->iteration?$loop->iteration:'N/A' }}</td>
            <td>{{ $department_val->department_name }}</td>
            <td>{{ $department_val->user->name??'N/A' }}</td>
            <td>{{ $department_val->department_email }}</td>
            <td>{{ $department_val->department_phone_number }}</td>
            <td>{{ $department_val->department_address?$department_val->department_address:'N/A' }}</td>
            <td>{{ $department_val->department_working_hours }}</td>
            <td>{{ $department_val->shift_start_time?$department_val->shift_start_time:'N/A' }}</td>
            <td>{{ $department_val->shift_end_time }}</td>
            
            
            <td> <img src="{{ url('storage/'.$department_val->department_image) }}" alt="" style="border-radius: 50%; width: 50px" loading="lazy"> </td>
            
            {{-- <form action="{{ url('categories//changestatus'$department_val->id) }}" method="post"> --}}
            <form action="categories/{{ $department_val->id }}" method="post">
                @csrf
                @method('PUT')
                
                 <td><button type="submit" @if($department_val->department_status=='Active')class="btn btn-success status" value="Inactive" @else class="btn btn-warning status" value="Active" @endif name="Department_Status_on_index" id="{{ $department_val->id }}" onclick="button({{ $department_val->id}})">{{ $department_val->department_status }}</button></td>
                
            </form> 
        
            
            <td style="width:0px">
                {{-- <a href="{{ url('categories/'.$department_val->id.'/edit') }}" class="btn btn-primary" data-toggle="modal" data-target="#editdepartmentModal" >Edit</a> --}}
               
                <button value="{{ $department_val->id }}" class="edit custom-button-edit" data-toggle="modal" data-target="#departmentModal" onclick="changeButton({{ $department_val->id }})" ><i class="fas fa-edit fa-lg"></i></button>
                {{-- <button value="{{ $department_val->id }}" class="btn btn-primary edit" >Edit</button> --}}
               
                
            </td>
            <td style="width:0px">
                <form action="{{ route('categories.destroy',$department_val->id) }}" class="form" method="post">
                    @csrf
                    @method('DELETE')
                   <button type="submit" class="custom-button"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                </form>
            </td>
            
           
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="13" class="text-center">Record Not Found</td>
        </tr>
      @endif
    </tbody>

      </table>

    </div>
</div> 
<script>

$('.form').submit(function(e){
    if(!confirm("Do You Really Want to Delete this Field")){
    e.preventDefault();
}
})

// $('#submit').submit(function(success){
//   alert("Hllo");
//     success.preventDefault(); 

// })
// ------------------onchange staus department status---
// $(document).ready(function(){
//   $("button").click(function(){
//     alert(this.id);
//   });
// });
// -----------------
// function button(id){
  // console.log(id);
  $(".status").click(function(status){
    // console.log(this.id);
    this.id;
    if(!confirm("Do You Really Want to Update Department Status")){
    status.preventDefault();
}
})

$(document).ready(function(){
  $('.toggle_class').toggle(3000);
  // $('#departmentModal').modal({backdrop: 'static', keyboard: false});

});
</script>

<script>
$(document).on('click','.edit',function(e){
    e.preventDefault;

    var depart=$(this).val();
    // console.log(depart);
    // $('#departmentModal').model('show')
    $('#departmentModal').modal({backdrop: 'static', keyboard: false});
    $.ajax({
        type:'GET',
        url:'categories/'+depart+'/edit',
        success: function(responce){
            console.log(responce);
            if(responce.status==200){
          
            
            // ------------------------------------
                $('#edit_Department_Name').val(responce.category.department_name);
                $('#edit_hod').val(responce.category.head_of_department);
                $('#edit_Department_Email').val(responce.category.department_email);
                $('#edit_Department_Phone_Number').val(responce.category.department_phone_number);
                $('#edit_Department_Address').val(responce.category.department_address);
                $('#edit_shift_start_time').val(responce.category.shift_start_time);
                $('#edit_shift_end_time').val(responce.category.shift_end_time);
                $('#edit_Department_Working_Hours').val(responce.category.department_working_hours);
              //  -------------------------------
               
                $('.src').attr('src','{{ url('storage') }}'+'/'+responce.category.department_image);
                
               

                if(responce.category.department_status=="Active" ){
                $('#edit_check1').attr('checked','checked');

                }else{
                  $('#edit_check2').attr('checked','checked');

                }
                $('#Department_Images').val(responce.category.department_image);
                

               

            }
        }
    })
    
})


function changeButton(id){
  // console.log("categories/"+id);
    document.getElementById("submit").innerHTML="Update";
    document.getElementById("heading").innerHTML="Update Department";
    document.getElementById("edit_department").innerHTML="Add Department";
    document.getElementById("table-container").setAttribute("action", "categories/"+id);
    document.getElementById("putmethod").value="PUT";
    document.getElementById("src").style.display='block';


    // document.getElementById("table-container").value("PUT");
 
}
// --------------------test--
// $('.edit').click(function(){
//       // console.log("hello");
//       var id=$(this).val();
//      $('#table-container').attr('action', '{{url('categories/id')}}');
//      $('#table-container').attr('method', 'PUT');

   
// });
// ------------testend----------
function refresh(){
  $('#edit_check1').removeAttr('checked');
    $('#edit_check2').removeAttr('checked');
    document.getElementById("src").style.display='none';
    document.getElementById("putmethod").value="";
    document.getElementById("heading").innerHTML="Add Department";
    document.getElementById("submit").innerHTML="Submit";
    document.getElementById("edit_Department_Name").value="";
    document.getElementById("edit_Department_Email").value="";
    document.getElementById("edit_Department_Phone_Number").value="";
    document.getElementById("edit_Department_Address").value="";
    document.getElementById("edit_shift_start_time").value="";
    document.getElementById("edit_shift_end_time").value="";
    document.getElementById("edit_Department_Working_Hours").value="";
    document.getElementById("edit_Department_Image").value="";
    document.getElementById("edit_hod").value="";
    document.getElementById("department_image").value="";
    
    // document.getElementById("#select_any_one").value="Select any One";

   
    // $('#edit_check2').attr('checked','');  
}
function resetform(){
  document.getElementById("table-container").reset();
  $('#departmentModal').modal({backdrop: 'static', keyboard: false});

  
}

</script>
<script>



//   $('#submit').click(function(){
//    $('#table-container').attr('action', '{{ url('categories') }}');
   
// });



// $(document).ready(function(){
//   $(document).on('click','.submit',function(e){
//     e.preventDefault();
//     // console.log("hello");
//     var data ={
//                 'Department_Name' : $('#edit_Department_Name').val(),
//                 'Head_of_Department' : $('#edit_hod').val(),
//                 'Department_Email' : $('#edit_Department_Email').val(),
//                 'Department_Phone_Number' : $('#edit_Department_Phone_Number').val(),
//                 'Department_Address' : $('#edit_Department_Address').val(),
//                 'shift_start_time' : $('#edit_shift_start_time').val(),
//                 'shift_end_time' : $('#edit_shift_end_time').val(),
//                 'Department_Working_Hours' : $('#edit_Department_Working_Hours').val(),
//                 'Department_Status' : $('#edit_check1').val(),
//                 'Department_Image' : $('#Department_Image').val(),
//     }
//     // console.log(data);
//     $.ajaxSetup({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//       });
//     $.ajax({
//       type:"POST",
//       url:'/categories',
//       data:data,
//       datatype:'json',
//       success: function(res){
//         console.log(res);
        

        // $.each(res.errors, function (key, value) {
      //    if(res.status==400){
      //     console.log("i am if")
      //       $('#savefrom_list').html("");
      //       $('#savefrom_list').addClass('alert alert-danger');
      //       $('#savefrom_list').append('<li>'+value+"</li>");
       


      //    }else{
      //     console.log("i am else")
      //       $('#savefrom_list').html(" ");
      //       $('#savefrom_list').val(" ");
      //       // $('#savefrom_list').delete();
      //       // $('#success_message_id').addClass('alert alert-success');
      //       // $('#success_message_id').text(res.message)
      //       // $('#departmentModal').model('hide')
      //       // $('#departmentModal').find('input').val("");

      //    }
          
           
      //   });
        

      // }

//       statusCode: {
//       200: function (response) {
//         console.log("i am 200");
//         $('#savefrom_list').html("");
//         $('#savefrom_list').removeClass('alert alert-danger');
//             // $('#savefrom_list').val(" ");

//       },
//           422: function (response) {
//             console.log("i am 4231");
//             $('#savefrom_list').html("");
//                 $('#savefrom_list').addClass('alert alert-danger');
//                 $('#savefrom_list').append('<li>'value"</li>");
//           }
//       }, success: function () {
//         console.log("success");
//       // alert('1');
//    },

//     })
                

//   })
// })


</script>

@endsection
