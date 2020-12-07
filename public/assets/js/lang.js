jQuery(document).ready(function ($) {
    $('.ru').click(function (e) {
        $.ajax({
            type: 'POST',
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
            },  // Add this line
            url: 'setLocale',
            data: {locale: 'ru'},
            dataType: 'json',
            success: function (respond) {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });
    $('.en').click(function (e) {
        $.ajax({
            type: 'POST',
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
            },  // Add this line
            url: 'setLocale',
            data: {locale: 'en'},
            dataType: 'json',
            success: function (respond) {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });
})
