@php
$view = (\Auth::check()) ? 'app' : 'login';
@endphp
@extends('layouts.'.$view)
@section('content')
<div id="profile-main-sec clearfix">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="top:100px">
            <h1 class="text-xxl text-primary text-center">Exception occurred while handling request</h1>
            <div class="text-center">
                <h3>Oops ! Something went wrong</h3>
                <p class="label-danger">Error - {{$message}}. </p>
                <p>Return <a href="{{url('/home')}}">Home</a></p>
            </div>
        </div>
    </div>

</div>
@endsection