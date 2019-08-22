$(function () {
    $('#datatable-full').DataTable({
        'paging': true,
        "pageLength": 100,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'dom': 'Bfrtip',
        'buttons': [
            'excel', 'pdf', 'print'
        ]
    });

    $('#datatable-standard').DataTable({
        'paging': true,
        "pageLength": 100,
        'lengthChange': false,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true
    });
})
