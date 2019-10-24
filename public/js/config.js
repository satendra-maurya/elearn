$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

// logout request as post not get
$(function () {
    $('#logout').click(function (e) {
        e.preventDefault();
        return confirm('do you want to proceed');
        $('#logout-form').submit();
    });
    $('.login-btn').click(function (e) {
        $('.login-btn').attr('disabled', true);
        $("form").submit();
    });
});

// back button reload page
window.onpageshow = function (event) {
    if (event.persisted) {
        window.location.reload()
    }
};

window.app = {}; //main namespace
var appSettings = {
    pageLength: 15,
    baseUrl: function () {
        return document.location.origin;
    },
}

$(function () {
    $('#userDeactivation').on('show.bs.modal', function (e) {
        $('#deactiveUserId').val(e.relatedTarget.dataset.id);
    });

    $('#userActivation').on('show.bs.modal', function (e) {
        $('#userId').val(e.relatedTarget.dataset.id);
    });
});

// comman function
function Activate() {
    var userId = $('#userId').val();
    alert('hello');
    $.ajax({
        type: 'PUT',
        url: $('#url').val() + '/update' + userId,
        data: {
            'status': true,
            '_token': $('#token').val()
        },
        cache: false,
        beforeSend: function () {
            $('#userActivation').modal('hide');
            $('.bg-loader').show();
        },
        success: function () {
            $('.bg-loader').hide();
            $('#hide_' + userId).css({'display': 'inline', 'visibility': 'visible'});
            $('#unhide_' + userId).css({'display': 'none', 'visibility': 'hidden'});
            refreshTable();
        },
        error: function () {
            $('.bg-loader').hide();
        }
    });
}

function DeActivate() {
    var id = $('#deactiveUserId').val();
    $.ajax({
        url: $('#url').val() + '/' + id,
        type: 'PUT',
        data: {
            'status': false,
            '_token': $('#token').val(),
        },
        beforeSend: function () {
            $('#userDeactivation').modal('hide');
            $('.bg-loader').show();
        },
        success: function (response) {
            $('.bg-loader').hide();
            $('#hide_' + id).css({'display': 'none', 'visibility': 'hidden'});
            $('#unhide_' + id).css({'display': 'inline', 'visibility': 'visible'});
            refreshTable();
        },
        error: function () {
            $('.bg-loader').hide();
        }
    });
}