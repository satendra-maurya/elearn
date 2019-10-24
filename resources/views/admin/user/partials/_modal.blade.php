<div class="box box-widget widget-user">
    <div class="widget-user-header bg-aqua-active">
        <h3 class="widget-user-username">{{ $user->username ?? 'Name'}}</h3>
        <h5 class="widget-user-desc">{{ $user->email ?? 'No Email'}}</h5>
    </div>
    <div class="widget-user-image">
        <img class="img-circle" src="{{$user->profile_image ?? url('images/placeholder.png')}}" alt="CommonCents">
    </div>
    <div class="box-footer">
<!--        <div class="row">
            <div class="col-sm-6 border-right">
                <div class="description-block">
                    <h5 class="description-header">{{$user->total_events}}</h5>
                    <span class="description-text">Events</span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="description-block">
                    <h5 class="description-header">{{$user->total_friends}}</h5>
                    <span class="description-text">Friends</span>
                </div>
            </div>
        </div>-->
    </div>
</div>