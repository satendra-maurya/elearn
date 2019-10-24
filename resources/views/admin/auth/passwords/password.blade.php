@extends('admin.layouts.app')
@section('content')

@include('admin.dashboard.partials.breadcum', [
'title' => trans('site.change_password'),
'icon' => 'gears'
])
<section class="content">
    <!-- /.content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(session()->has('success'))
                        @include('admin.partials/error', ['type' => 'success', 'message' => session('success')])
                        @endif
                        @if(session()->has('error'))
                        @include('admin.partials/error', ['type' => 'danger', 'message' => session('error')])
                        @endif

                        {!! Form::open(['url' => route('admin.password.change'), 'method' => 'post', 'role' => 'form']) !!}
                        <div class="form-group has-feedback {{ $errors->has('old_password') ? 'has-error' : '' }}">
                            <input type="password" name="old_password" class="form-control"
                                   placeholder="{{ trans('site.old_password') }}">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if ($errors->has('old_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" name="password" class="form-control"
                                   placeholder="{{ trans('site.new_password') }}">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="{{ trans('site.confirm_password') }}">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat login-btn">Sign In</button>
                </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection