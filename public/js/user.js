$(document).ready(function () {
    'use strict';
    console.log(app);
    $("#user-detail").on("show.bs.modal", function (e) {
        var id = $(e.relatedTarget).data('id');
        $.get(appSettings.baseUrl()+'/admin/user/' + id, function (data) {
            $(".user-detail").html(data.html);
        });
    });
});
app.user = (function ($) {
    'use strict';
    var config = {};
    var init = function (settings) {
        $.extend(config, settings || {});
        loadUser();
    };
    var loadUser = function () {
        console.log(appSettings);
        console.log(appSettings.baseUrl() + '/admin'+config.url);
        var oTable = $('#users-table').DataTable({
            ajax: {
                url: appSettings.baseUrl() + '/admin'+config.url,
                data: function (d) {
                    d.search = $('#search').val();
                },
                error: function (xhr, status, error) {
                    $(".users-table-error").html("");
                    $("#users-table").append('<tbody class="nas-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
                    $("#users-table_processing").css("display", "none");
                },
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
               // {data: 'is_email_verified', name: 'is_email_verified'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });
        $("input#search").on("keyup", function (event) {
            if ($('#search').val().length >= 3 || $('#search').val().length == 0) {
                oTable.draw(), event.preventDefault()
            }
        });
        $("#btn-search").click(function (a) {
            oTable.draw(), a.preventDefault()
        });
    };
    return {init: init}
})

        (jQuery);

$(function () {
    app.user.init({"url": "/user"});
});

function refreshTable() {
    var oTable = $('#users-table').DataTable();
     oTable.draw();
}