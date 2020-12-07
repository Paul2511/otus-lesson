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
    function addBtn() {
        $('.dataTables_filter').prepend('<label style="margin-bottom: 30px;">' +
            '<a href="' + route_create +'">' +
            '<svg style="height: 40px;border: 1px solid #e0e6ed !important; box-shadow: 2px 5px 17px 0 rgba(31, 45, 61, 0.1); color:#5c1ac3; bottom: 15px;border-top-width: 5px;margin-top: 0;margin-bottom: -20px;top: 5px;padding: 10px;width: 40px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></a></label>');
    }

    addBtn();

    $('.block-user').click(function(event) {
        $.ajax({
            type: 'POST',
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
            },  // Add this line
            url: 'users/active/' + $(this).data('user'),
            data: {is_active: 0},
            dataType: 'json',
            success: function (respond) {
                Snackbar.show({
                    text: 'Сохранено успешно',
                    actionTextColor: '#fff',
                    backgroundColor: '#8dbf42',
                    pos: 'top-right',
                    actionText: "Закрыть",
                });
                window.location.reload();
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

    $('.unblock-user').click(function(event) {
        $.ajax({
            type: 'POST',
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
            },  // Add this line
            url: 'users/active/' + $(this).data('user'),
            data: {is_active: 1},
            dataType: 'json',
            success: function (respond) {
                Snackbar.show({
                    text: 'Сохранено успешно',
                    actionTextColor: '#fff',
                    backgroundColor: '#8dbf42',
                    pos: 'top-right',
                    actionText: "Закрыть",
                });
                window.location.reload();
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

} );
