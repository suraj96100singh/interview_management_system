@extends('layouts.app')
@section('content')
{{-- @include('header.head') --}}
{{-- @dd($interview->id) --}}

{{-- <div class="alert alert-primary">
<h3>Interviews Question</h3>
</div> --}}


<div class="modal-dialog modal-xl border border-white">
    <div class="modal-content alert alert-secondary">
       <div class="modal-header alert alert-secondary">
           <h4 class="modal-title ">Questions</h4>
       </div>
       {{-- @dd($interview); --}}
       <div class="modal-body alert alert-primary">
        @php
            $parameter =[
            'id' =>$interview->id,
        ];
            $parameter= Crypt::encrypt($parameter);
        @endphp
        
        <form action="{{ route('interview.examcalculation', $parameter)}}" method="post">
           {{-- @dd($all_question_val) --}}
            @csrf
            @method('PUT')
           @foreach ($all_question as $all_question_val)
            <dl class="h4 bg-primary py-3">{{ $loop->iteration }}. &nbsp;{{ $all_question_val->Question }} ?</dl>
            {{-- <div class="h4 m-2 bg-primary">{{ $loop->iteration }}{{ $all_question_val->Question }} ?</div> --}}
            
            <ol type="A">
                @foreach ($all_question_val->options as $option_val)
                <li class="list-group-item list-group-item-action main_{{ $option_val->id }}_{{ $all_question_val->id }}" id="{{ $all_question_val->id }}_{{ $option_val->id }}"> <input type="radio" value="{{ $option_val->id }}" name="selected_options_{{ $option_val->question_id }}" class="mr-5 checked_check" id="{{ $option_val->id }}" onclick="bgchange(this.id,{{ $all_question_val->id }})"><label for="{{ $option_val->id }}">{{ $option_val->options }}</label></li>
                @endforeach
            </ol>
           </ul>
               
           @endforeach
           <div class="text-center m-5 ">
            <button type="submit" class="btn btn-primary">Submit Test</button>
           </div>
        </form>
       </div>
       
    </div>
</div>


@endsection
<script>
// document.onkeydown = function(){
//   switch (event.keyCode){
//         case 116 : //F5 button
//             event.returnValue = false;
//             event.keyCode = 0;
//             return false;
//         case 82 : //R button
//             if (event.ctrlKey){ 
//                 event.returnValue = false;
//                 event.keyCode = 0;
//                 return false;
//             }
//     }
// }


</script>