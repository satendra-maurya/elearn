<div id="userDeactivation" class="modal fade in msg-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body-box">
                <div class="modal-header">
                    <button type="button" class="close" onClick="delText()" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm</h4>
                </div>
                <div class="modal-body">
                    <form class="my-form" name="hideReasonForm" id="hideReasonForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="hide_url" value="{{ $link }}">
                        <p> {!! $title !!} </p>
                        <input type="hidden" value="" name="userId" id="deactiveUserId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default blue-opt-btn" onClick="delText()" data-dismiss="modal">Cancel</button>
                    <input type="button" class="btn btn-success blue-btn" id="hideSubmit" onClick="DeActivate()" value="Submit">
                </div>
            </div>
        </div>
    </div>
</div>