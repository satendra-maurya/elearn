@extends('admin.layouts.app')
@section('content')

@include('admin.dashboard.partials.breadcum', [
'title' => trans('site.home'),
'icon' => 'dashboard'
])
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Welcome</h3>
                </div>
                <div class="box-body">
                    <div class="alert alert-info alert-dismissible">
                        <h4><i class="icon fa fa-info"></i> {{trans('site.app_name')}} Dashboard</h4>
                        <p style="text-align:justify">{{trans('site.app_name')}} Portal makes management even easier. Simply log in to your online account at any 
                            time for up-to-date information</p>
                        <p style="text-align:justify">&nbsp;&nbsp;&nbsp;<strong>&nbsp; Use {{trans('site.app_name')}} Portal to:</strong></p>
                        <ol>
                            <li style="text-align:justify">&nbsp;Manage <strong>app users </strong> account.</li>
                            <li style="text-align:justify">&nbsp;Check <strong>donations</strong>.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--    <div class="row">
        @each('dashboard/partials/pannel', $pannels, 'pannel')
    </div>-->
</section>

@endsection
