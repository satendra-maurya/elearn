<section class="content-header">
    <h4>
        <i class="fa fa-{{ $icon }}"></i> {!! $title !!}
    </h4>
    @if(isset($addNewButton))
    <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ $route }}">Add New</a>
    </h1>
    @endif
</section>
