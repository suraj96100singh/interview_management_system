@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
            <div class="card">
            <div class="text-center btn btn-primary" >
                    {{-- <b> Add User</b>    --}}
                    @if(isset($user)) <b> Update {{$user->name}} Details</b>  @else   <b> Add User</b>     @endif
            </div>
              <div >
              <div class="card-body">  
                {{-- @dd($user) --}}
                        <form @if(isset($user)) action = "{{route('users.update',$user->id)}}" @endif action="{{url('users')}}" method="post">
                          @if(isset($user))
                          @method('PUT')
                          @endif
                          @csrf
                            <div class="form-group">
                                  <label for="user_name"><b>User Name</b></label>
                                  <span class="text-danger">*</span>
                                  <input class="form-control rounded-pill {{$errors->any() && $errors->first('user_name')?'is-invalid':''}}" value="{{old('user_name')?old('user_name'):$user->name??""}}"    type="text" name="user_name" placeholder="Enter User Name">
                                  @if($errors->any())
                                  <p class="invalid-feedback">{{$errors->first('user_name')}}</p>
                                  @endif
                                </div> 
                              <div class="form-group">
                                <label for="department"><b>Department</b></label>
                                <span class="text-danger">*</span>
                                {{-- @dd($user->department->department_name) --}}
                                <select name="department" id="" class="form-control rounded-pill {{$errors->any() && $errors->first('department')?'is-invalid':''}}" @if(isset($user)) value="{{ $user->department->id }}" selected @endif>
                                  @if($errors->any())
                                  <p class="invalid-feedback">{{$errors->first('department')}}</p>
                                  @endif
                                  <option value="">--Select Any User--</option>
                                  @foreach ($department as $departments)
                                  <option value="{{ $departments->id }}"{{ (old("department") == $departments->id ? "selected":"") }} @if(isset($user))@if($departments->id==$user->department->id)  selected    @else value="{{ $departments->id }}" @endif   @endif > {{ $departments->department_name }}</option>
                                  @endforeach
                                  
                                </select>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('department')}}</p>
                                @endif
                                
                              </div>
                              <div class="form-group">
                                <label for="user_roles"><b>Roles</b></label>
                                <span class="text-danger">*</span>
                                <select name="user_roles" id="" class="form-control rounded-pill {{$errors->any() && $errors->first('user_roles')?'is-invalid':''}}" >
                                  @if($errors->any())
                                  <p class="invalid-feedback">{{$errors->first('user_roles')}}</p>
                                  @endif
                                  <option value="" >--Select Any User--</option>
                              
                                  @foreach ($roles as $role_data)
                                  <option value="{{ $role_data->id }}" {{ (old("user_roles") == $role_data->id ? "selected":"") }} @if(isset($user))  @if($role_data->id==$user->roles->id) selected @else   value="{{ $departments->id }}"  @endif @endif>{{ $role_data->roles_name }}</option>
                                  @endforeach
                                  
                                </select>
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('user_roles')}}</p>
                                @endif
                                
                              </div>
                              <div class="form-group" @if (isset($user)) style="display: none" @else style="display:block" @endif>
                                <label for="user_email"><b>Email</b></label>
                                <span class="text-danger">*</span>
                                <input class="form-control rounded-pill {{$errors->any() && $errors->first('user_email')?'is-invalid':''}}" value="{{old('user_email')}}" id="user_email" type="email" @if(isset($user))  @else name="user_email" @endif placeholder="Enter Email">
                                @if($errors->any())
                                  <p class="invalid-feedback">{{$errors->first('user_email')}}</p>
                                  @endif
                              </div>
                              
                              <div class="form-group" @if (isset($user)) style="display: none" @else style="display:block" @endif>
                                <label for="user_password"><b>Password</b></label>
                                <span class="text-danger">*</span>
                                
                                <input class="form-control rounded-pill {{$errors->any() && $errors->first('user_password')?'is-invalid':''}}" value="{{old('user_password')}}" id="user_password" type="password" @if(isset($user)) @else name="user_password" @endif placeholder="Enter Password">
                                @if($errors->any())
                                  <p class="invalid-feedback">{{$errors->first('user_password')}}</p>
                                  @endif
                              </div>
                              <div class="form-group">
                                <label for="user_phone_number"><b>Phone Number</b></label>
                                <span class="text-danger">*</span>
                                <input class="form-control rounded-pill {{$errors->any() && $errors->first('user_phone_number')?'is-invalid':''}}" @if(isset($user)) value="{{$user->system_user_phone}}"  @else value="{{old('user_phone_number')}}" @endif id="user_phone_number" type="number" name="user_phone_number" placeholder="Enter phone Number">
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('user_phone_number')}}</p>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="user_address"><b>Address</b></label>
                                <textarea name="user_address" id="user_address" cols="" rows="" class="form-control rounded-pill" placeholder="Enter User Address" >@if(isset($user)) {{$user->ststem_user_address}}@endif</textarea>
                               
                              </div>
                              <div class="form-group">
                                <label for="user_experience"><b>Experience</b></label>
                                <span class="text-danger">*</span>
                                {{-- @dd($user) --}}
                                <input class="form-control rounded-pill {{$errors->any() && $errors->first('user_experience')?'is-invalid':''}}" @if(isset($user)) value="{{$user->experience}}"  @else value="{{old('user_experience')}}" @endif id="user_experience" type="text"  name="user_experience" placeholder="YY.MM">
                                @if($errors->any())
                                <p class="invalid-feedback">{{$errors->first('user_experience')}}</p>
                                @endif
                              </div>
                              <div class="text-center">
                              <button class="btn btn-success">@if (isset($user)) Update @else Save @endif</button>
                              </div>
                        </form>       
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
{{-- ----------------------------------------------------------Edit------- --}}
@endsection