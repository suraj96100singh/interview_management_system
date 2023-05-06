@extends('layouts.app')

@section('content')
@include('header.head')

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
<div class="table-responsive" style="height:800px">
    <table class="table table-dark table-striped">
        <thead class="sticky-top table-dark">
          
        <tr>
            <th>S.No</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Role</th>
            <th>Department</th>
            <th>Experience</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
        
    </thead>
    <tbody>
      @if(count($users))
      @foreach ($users as $users_val)
      
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $users_val->name}}</td>
            <td>{{ $users_val->email}}</td>
            <td>{{ $users_val->system_user_phone}}</td>
            <td>{{ $users_val->ststem_user_address}}</td>
            <td>{{ $users_val->roles->roles_name}}</td>
            <td>{{ $users_val->department->department_name??'N/A'}}</td>
            <td>{{ $users_val->experience}}</td>
            <td>
                <form action="{{ url('users/'.$users_val->id.'/edit') }}" method="post">
                    @csrf
                   @method('GET')
                 <button type="submit"><i class="fas fa-edit" ></i></button>  
                </form> 
            </td>
            <td>
                <form action="{{ route('users.destroy',$users_val->id) }}" class="deletedata" method="post">
                    @csrf
                    @method('DELETE')
                   <button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
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