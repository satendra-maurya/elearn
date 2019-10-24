@extends('admin.layouts.login')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><img src="{{url('images/logo-full.png')}}" alt="logo" width="250"></a>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading bg-color">Login</div>
        <div class="panel-body">

            @if(session()->has('error'))
            @include('partials/error', ['type' => 'danger', 'message' => session('error')])
            </hr>
            @endif
            @if(session()->has('success'))
            @include('partials/error', ['type' => 'success', 'message' => session('success')])
            </hr>
            @endif

            {!! Form::open(['url' => route('admin.login'), 'method' => 'post', 'role' => 'form']) !!}
            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('auth.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('auth.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat login-btn">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
            {!! Form::close() !!}
            {!! link_to('password/reset', trans('site.forget')) !!}
        </div>
    </div>
</div>

@endsection