@extends('layouts.app')

@section('content')
{{-- @dd($interview) --}}
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Candidate</h5>
                   
                    <a class="card-text" href="{{ route('interviewers.index','filter=0') }}" style="color:white" onclick="filterWiseRecord(0)">{{ count($interview) }}</a>
                  
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Accepted Candidate</h5>
                    <a class="card-text" href="{{ route('interviewers.index','filter=2') }}" style="color:white" onclick="filterWiseRecord(2)">{{ $accepted_candidate }}</a>
                 </div>         
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Rejected Candidate</h5>
                    <a class="card-text" href="{{ route('interviewers.index','filter=3') }}" style="color:white" onclick="filterWiseRecord(3)">{{ $rejected_candidate }}</a>
                 </div>         
            </div>
        </div>
     </div>
</div>
@endsection


