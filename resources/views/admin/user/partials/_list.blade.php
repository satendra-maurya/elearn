@if(isset($status))
   @if($user->is_active == 1)
    <i class="fa fa-thumbs-up text-green" aria-hidden="true"></i> Verified
    @else
    <i class="fa fa-thumbs-down text-red" aria-hidden="true"></i> Not-Verified
    @endif
@else
    <a class="btn btn-primary btn-sm" data-id="{{$user->id}}" href="#" data-toggle="modal" data-target="#user-detail">
        <i class="fa fa-eye"></i> View</a>
    @php
    $suspend = ($user->is_active) ? "visibility:visible; display:inline;" : "visibility:hidden; display:none;";
    $active = ($user->is_active) ? "visibility:hidden; display:none;" : "visibility:visible; display:inline;";
    @endphp
    <a class="btn btn-success btn-sm" id="unhide_{{$user->id}}" data-id="{{$user->id}}" href="#" data-toggle="modal" data-target="#userActivation" style="{{$active}}">
        <i class="fa fa-thumbs-up"></i> Activate</a>
    <a class="btn btn-danger btn-sm" id="hide_{{$user->id}}" data-id="{{$user->id}}" href="#" data-toggle="modal" data-target="#userDeactivation" style="{{$suspend}}">
        <i class="fa fa-thumbs-down"></i> Deactivate</a>
@endif