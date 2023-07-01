
@section('content')
@extends('layouts.app')
<div class="container">

    <div class="card-header bg-secondary dark bgsize-darken-4 white card-header w-100">
        <h4 class="text-white">Bulk Upload</h4>
    </div>
    <div class="row justify-content-center" style="margin-top: 4%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bgsize-primary-4 white card-header">
                    <h4 class="card-title d-inline">Import Questions Data</h4>
                    <a href="storage/question_sample_paper/question_sample_peper.xlsx" class="float-right"><i class="fa fa-download fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="card-body">
                    {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                           
                        </div>
                        <br>
                    @endif --}}
                    <form action="{{url("importingData")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                            <fieldset>
                                <div class="form-group m-2 d-inline">
                                    <label for=""><b>Select Department</b></label>
                                    <select name="selected_department" id="" class="form-control w-100 " required>
                                        <option value="">--Select any One--</option>
                                        @foreach ($department as $departmentval)
                                        <option value="{{ $departmentval->id }}">{{ $departmentval->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>   
                            </fieldset>
                        </div>
                        <div class="col-sm-12">
                            <fieldset>
                                    
                                    <label class="w-100"><b>Select File to Upload</b> <small class="warning text-muted ">{{__('Please upload only Excel (.xlsx or .xls) files')}}</small></label>
                                <div class="input-group">
                                    <input type="file"  class="form-control" name="uploaded_file" id="uploaded_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    
                                    
                                </div>
                                @if ($errors->has('uploaded_file'))
                                <p class="mb-0">
                                    <small class="text-danger" id="file-error">{{ $errors->first('uploaded_file') }}</small>
                                </p>
                            @endif
                            </fieldset>
                             
                        </div>
                        
                        
                        </div>
                        <div id="button-addon2" class="text-center mt-4">
                            <button class="btn btn-primary square" type="submit"><i class="ft-upload mr-1"></i> Upload</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>





{{-- <input type="text" class="main"> --}}
{{-- <button onclick="show()" id="d1">save</button>\
<script>
    function show(){
        $('#d1').attr('class','btn btn-primary')
    }
</script> --}}

@endsection
{{-- 
 --}}