<div id="userActivation" class="modal fade msg-Modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body-box">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirm</h4>
            </div>
            <div class="modal-body">
                <p>{!! $title !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default blue-opt-btn" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-default blue-btn" onClick="Activate()">Submit</button>
                <input type="hidden" value="" name="userId" id="userId">
                <input type="hidden" id="token" value="{{csrf_token()}}">
                <input type="hidden" id="url" value="{{ $link }}">
            </div>
        </div>
        </div>
    </div>
</div>