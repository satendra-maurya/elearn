@extends('layouts.login')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{url('/')}}"><img src="{{url('images/logo-full.png')}}" alt="logo" width="250"></a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading bg-color">Forgot Password</div>
                <div class="panel-body">
                    @if(session()->has('error'))
                    @include('partials/error', ['type' => 'danger', 'message' => session('error')])
                    </hr>
                    @endif
                    @if(session()->has('success'))
                    @include('partials/error', ['type' => 'success', 'message' => session('success')])
                    </hr>
                    @endif

                    {!! Form::open(['url' => 'password/email', 'method' => 'post', 'role' => 'form']) !!} 
                    {!! Form::text('email', 0, 'email', $errors, trans('site.email'),null,trans('site.email'),'envelope') !!}
                    {!! Form::submitBootstrap(trans('site.send'), '') !!}

                    {!! Form::close() !!}
                    {!! link_to('/', 'Login') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection