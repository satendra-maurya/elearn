@extends('layouts.reset')
@section('styles')
{!! Html::style('css/reset.css') !!}
@stop
@section('content')
<div class="container">
    <div class="login-box">
        <div class="logo-ctn">
            <a href="{{url('/')}}"><img src="{{url('images/logo.png')}}" alt="logo"></a>
        </div>
        <h5 class="page-heading">Reset Password</h5>
        @if(session()->has('error'))
        @include('partials/error', ['type' => 'danger', 'message' => session('error')])
        </hr>
        @endif
        @if(session()->has('success'))
        @include('partials/error', ['type' => 'success', 'message' => session('success')])
        </hr>
        @endif
        {!! Form::open(['url' => 'password/reset', 'method' => 'post', 'role' => 'form']) !!}
        {!! Form::hidden('token', $token) !!}
        {!! Form::hidden('email', $email) !!}
        <div class="form-group">
            <input type="password" class="form-control" id="pwd" placeholder="Password" name="password">
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation">
            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="text-center py-2">
            <button type="submit" class="btn col-12 login-btn col-sm-6 btn-app-primary">Reset password</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection