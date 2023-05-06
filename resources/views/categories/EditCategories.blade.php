{{-- @extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
            <div class="card">
            <div class="text-center btn btn-primary" >
                    <b> Update Department</b>   
            </div>
              <div >
                
              <div class="card-body">  
                        <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                  <label for="Department_Name"><b>Department Name</b></label>
                                  <span class="text-danger">*</span>
                                  <input class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Name')?'is-invalid':''}}" value="{{ $category->department_name }}" id="Department_Name" type="text" name="Department_Name" placeholder="Enter Department Name">
                                  @if($errors->any())
                                  <p class="invalid-feedback">{{$errors->first('Department_Name')}}</p>
                                  @endif
                                </div> 
                              <div class="form-group">
                                <label for="Head_of_Department"><b>HOD</b></label>
                                <span class="text-danger">*</span>
                                <select name="Head_of_Department" id="" class="form-control rounded-pill {{$errors->any() && $errors->first('Head_of_Department')?'is-invalid':''}}" >
                                  @foreach ($items as $username)
                                  <option value="{{ $username->id  }}"  @if($username->id==$category->head_of_department ) selected @endif>{{ $username->name }}
                                  </option>
                                  @endforeach
                                  @if($errors->any())
                                  <p class="invalid-feedback">{{$errors->first('Head_of_Department')}}</p>
                                  @endif
                                </select>

                                
                              </div>
                              <div class="form-group">
                                <label for="Department_Email"><b>Email</b></label>
                                <span class="text-danger">*</span>
                                <input class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Email')?'is-invalid':''}}" value="{{$category->department_email}}" id="Department_Email" type="email" name="Department_Email" placeholder="Enter Email">
                                @if($errors->any())
                                  <p class="invalid-feedback">{{$errors->first('Department_Email')}}</p>
                                  @endif
                              </div>
                              <div class="form-group">
                                <label for="Department_Phone_Number"><b>Phone Number</b></label>
                                <span class="text-danger">*</span>
                                <input class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Phone_Number')?'is-invalid':''}}" value="{{$category->department_phone_number}}" id="Department_Phone_Number" type="text" name="Department_Phone_Number" placeholder="Enter phone Number">
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('Department_Phone_Number')}}</p>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="Department_Address"><b>Address</b></label>
                              
                                <textarea name="Department_Address" id="Department_Address" cols="" rows="" class="form-control rounded-pill" placeholder="Enter Department Address">{{ $category->department_address }}</textarea>
                              </div>
                              <div class="form-group">
                                <label for="shift_start_time"><b>Shift Start</b></label>
                               
                                <input type="time" name="shift_start_time" class="form-xs-3 rounded-pill " value="{{ $category->shift_start_time }}" id="shift_start_time">
                                <label for="Total_Number_Employee"><b>Shift End</b></label>
                                
                                <input type="time" name="shift_end_time" class="form-xs-3 rounded-pill" value="{{ $category->shift_end_time }}" id="shift_end_time" onchange="diffrence()">
                                <label for="Department_Working_Hours" ><b>Workings Hours</b></label>
                               
                                <input type="text" name="Department_Working_Hours" class="form-xs-3 rounded-pill {{$errors->any() && $errors->first('Department_Working_Hours')?'is-invalid':''}}" placeholder="Hours" value="{{ $category->department_working_hours }}" id="Department_Working_Hours">
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('Department_Working_Hours')}}</p>
                                @endif
                              </div>
                              <div class="form-group">
                                
                              </div>
                              <div class="form-group">
                                <label for="check1" ><b>Department Status</b></label>
                                <div class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Status')?'is-invalid':''}}">
                                <label for="check1">Active</label>
                                    <input type="radio" name='Department_Status' id="check1" value="Active" @if($category->department_status=="Active") value="Active" checked @endif>
                                <label for="check2">Inactive</label>
                                    <input type="radio" name='Department_Status' id="check2" value="Inactive" @if($category->department_status=="Inactive") value="Inactive"  checked @endif>
                                  </div>
                                  @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('Department_Status')}}</p>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="Department_Image"><b>Upload Image</b></label>
                                <span class="text-danger">*</span>
                                <input class="form-control rounded-pill {{$errors->any() && $errors->first('Department_Image')?'is-invalid':''}}" id="Department_Image" type="file" name="Department_Image">
                                {{ $category->department_image }}
                              </div>
                              @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('Department_Image')}}</p>
                                @endif
                              <div class="text-center">
                              <button class="btn btn-success">Update</button>
                              </div>
                             </form>       
            </div>
          

          </div>

            </div>
        </div>
  </div>
</div>
<script>
function diffrence(){
    var start = document.getElementById("shift_start_time").value;
    var end = document.getElementById("shift_end_time").value;
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
    document.getElementById("Department_Working_Hours").value = diff(start , end);
    }
</script>
@endsection --}}