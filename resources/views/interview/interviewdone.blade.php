
@section('newcontent')
@extends('header.head');
<div class="text-center bg-success fixed-top">
    <h2>Thank you ! we will inform you as soon as possible at your given Mail Id.</h2>
    <h2 class="text-center">Have a Nice Day</h2>
    </div>
    <div style="height:800px;">
        <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_snmbndsh.json"  background="transparent"   speed="1"  autoplay></lottie-player>
    </div>
    <div class="text-center mt-5">
    <a @if(Auth::user('login'))href="{{ url('/home') }}" @else href="{{ url('/login') }}" @endif class="btn btn-primary"> @if(Auth::user('login')) Back to home @else Back to Login @endif </a>
    </div>
@endsection