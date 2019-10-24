$.extend(true, $.fn.dataTable.defaults, {
    processing: true,
    serverSide: true,
    paging: true,
    bFilter: false,
    pageLength: appSettings.pageLength,
    bLengthChange: true,
    info: true,
    "order": [[0, "asc"]],
});