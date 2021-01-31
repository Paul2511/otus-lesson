$(document).ready(function() {
    $('table.multi-table').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": sInfo,
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": search,
            "sLengthMenu": results,
            "sZeroRecords": sZeroRecords,
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7,

        drawCallback: function () {
            $('.t-dot').tooltip({ template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' });
            $('.dataTables_wrapper table').removeClass('table-striped');
        }
    });
    $('#build').click(function (e) {
        e.preventDefault();
        let date_period = $('#date_period').val();
        let project = $('#project').val();
        let phone = $('#phone').val();

        $.ajax({
            type: 'POST',
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
            },  // Add this line
            url: route_get_records,
            data: {project: project, date_period:date_period,phone:phone},
            dataType: 'json',
            success: function (respond) {
                let str = '';
                $.each(respond, function (index, element) {
                    str += '<tr>\n<td>' + element.calldate + '</td>\n' +
                        '<td>' + element.src + '</td>\n' +
                        '<td>' + element.billsec + '</td>\n' +
                        '<td></td>\n' +
                        '<td><a href="'+ element.link + '" class="params">Скачать</a></td>\n' +
                        '</tr>\n';
                });
                $("table#records tbody").html(str);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Snackbar.show({
                    text: jqXHR.responseText.message,
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'top-right',
                    actionText: "Закрыть",
                });
            }
        });
    });

});
