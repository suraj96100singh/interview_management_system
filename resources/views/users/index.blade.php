@extends('layouts.app')

@section('content')
{{-- @include('header.head') --}}

<div class="container-fluid mt-2">
    <div class="alert alert-primary h4">
      User Records
        <a href="{{route('users.create')}}" class="btn btn-primary float-right mb-2" id="edit_department" onclick="resetform()">Add User</a>
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
    <table class="table table-striped table-success table-hover">
        <thead class="bg-dark text-white">
          
        <tr>
            <th>S.No</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Role</th>
            <th>Department</th>
            <th>Experience</th>
            <th class="text-center" >Edit</th>
            <th class="text-center" >Delete</th>
        </tr>
        
    </thead>
    <tbody>
      @if(count($users))
      @foreach ($users as $users_val)
      {{-- @dd($users_val); --}}
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $users_val->name}}</td>
            <td>{{ $users_val->email}}</td>
            <td>{{ $users_val->system_user_phone}}</td>
            <td>{{ $users_val->ststem_user_address}}</td>
            <td>{{ $users_val->roles->roles_name}}</td>
            <td>{{ $users_val->department->department_name??'N/A'}}</td>
            <td>{{ $users_val->experience}}</td>
            <td style="width:1px">
                <form action="{{ url('users/'.$users_val->id.'/edit') }}" method="post">
                    @csrf
                   @method('GET')
                 <button type="submit" class="custom-button-edit"><i class="fas fa-edit fa-lg" ></i></button>  
                </form> 
            </td>
            <td style="width:1px">
                <form action="{{ route('users.destroy',$users_val->id) }}" class="deletedata" method="post">
                    @csrf
                    @method('DELETE')
                   <button type="submit" class="custom-button"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                 </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="9" class="text-center">Record Not Found</td>
        </tr>
        @endif
    </tbody>



    </table>

    </div>
</div> 
<script>
// ---------------------------delete_data_from_form----

    $('.deletedata').submit(function(e){
    if(!confirm("Do You Really Want to Delete this Field")){
    e.preventDefault();
}
})
// ---------------------------------------session_toggle----

$(document).ready(function () {
    $('.toggle_class').toggle(2000)
    
    
});
</script>

@endsection