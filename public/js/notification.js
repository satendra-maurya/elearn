$(function() {
        $('#notification-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: appSettings.baseUrl()+'/notification',
            columns: [
                {data: 'user', name: 'user.name'},
                {data: 'type', name: 'type'},
                {data: 'message', name: 'message'},
                {data: 'is_read', name: 'is_read'},
                {data: 'created_at', name: 'created_at'}
                // {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });
    });
