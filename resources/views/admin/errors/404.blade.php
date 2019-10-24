@extends('layouts.login')
@section('content')
<section class="content" style='margin-top: 15%; background: white;'>
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{ url('/') }}">return to home.</a>
            </p>
        </div>
    </div>
</section>
@endsection
