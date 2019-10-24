@extends('admin.layouts.app')
@section('styles')
{!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
{!! Html::style('plugins/datatables/responsive.bootstrap.min.css') !!}
@stop
@section('content')
@include('admin.dashboard.partials.breadcum', [
'title' => trans('site.user_list'),
'icon' => 'user'
])
<section class = "content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    &nbsp;
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group celebrity-searchbox">
                                <input type="text" class="form-control col-xs-12" placeholder="Email/ Name / Username" value="" id="search">
                                <span class="add-clear-x form-control-feedback glyphicon glyphicon-remove-circle" 
                                      style="cursor: pointer; text-decoration: none; overflow: hidden; position: absolute; pointer-events: auto; right: 0px; top: 0px;"></span>
                                <div class="input-group-btn">
                                    <button class="btn btn-default" id="btn-search" type="button"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>
@include('admin.partials.activemodal', [
'title' => trans('site.activate'),
'link' => url('admin/user/update')
])

@include('admin.partials.suspendmodal', [
'title' => trans('site.deactivate'),
'link' => url('user')
])

@include('admin.partials.loading')
@include('admin.user/partials._detail')

@push('scripts')
{!! Html::script('plugins/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('plugins/datatables/dataTables.bootstrap.min.js') !!}
{!! Html::script('plugins/datatables/dataTables.responsive.min.js') !!}
{!! Html::script('plugins/datatables/dataTables.bootstrap.min.js') !!}
{!! Html::script('js/datatable.js') !!}
{!! Html::script('js/user.js') !!}
@endpush
@endsection

