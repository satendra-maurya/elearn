<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box {{ $pannel->color }}">
        <span class="info-box-icon"><i class="fa fa-{{ $pannel->icon }}"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">{{ $pannel->name }}</span>
            <span class="info-box-number">{{$pannel->nbr->total}}</span>
            <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
                <a href="{{ $pannel->url }}" class="small-box-footer" style='color:white'>
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </span>
        </div>
    </div>
</div>