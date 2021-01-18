$(document).ready(function ($) {
    /*
         Open the modal to CREATE a link
    */

    $('#btn-add').click(function () {
        $('#btn-save').val("add");
        $('#userFormData').trigger("reset");
        $('#userFormData input').removeClass('is-invalid').removeClass('is-valid');
        $('#userEditorModal').modal('show');
    });
    /*
         Open the modal to UPDATE a link
    */

    $('body').on('click', '.open-modal', function () {
        $('#userFormData input').removeClass('is-invalid').removeClass('is-valid');
        var user_id = $(this).val();
        $.get('users/' + user_id, function (data) {
            $('#user_id').val(data.id);
            $('#counterpartyInn').val(data.inn);
            $('#first_name').val(data.first_name);
            $('#last_name').val(data.last_name);
            $('#middle_name').val(data.middle_name);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
            $('#affilatedCompany').val(data.affilated_company);
            $('#position').val(data.position);
            $('#status').val(data.status);
            $('#role').val(data.role.name);
            $('#btn-save').val("update");
            $('#userEditorModal').modal('show');
        })
    });

    /*
         Clicking the save button on the open modal for both CREATE and UPDATE
    */
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var userFormData = {
            inn: $('#counterpartyInn').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            middle_name: $('#middle_name').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            password: $('#password').val(),
            confirm: $('#confirm').val(),
            affilated_company: $('#affilatedCompany').val(),
            position: $('#position').val(),
            status: $('#status').val(),
            role: $('#role').val(),
        };
        var state = $('#btn-save').val();
        var type = "POST";
        var user_id = $('#user_id').val();
        var ajaxurl = 'users';
        if (state == "update") {
            type = "PUT";
            ajaxurl = 'users/' + user_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: userFormData,
            dataType: 'json',
            success: function (data) {
                $('#userModalData').trigger("reset");
                $('#userEditorModal').modal('hide');
                $('#users-table').load(location.href+' #users-table>*','').hide().fadeIn(800);
                $(this).remove();
            },
            error: function (data) {
                errors = data.responseJSON.errors;
                console.log(errors);
                $.each(errors, function (key, value) {
                    if (value === "") {
                        $('#' + key).addClass('is-valid');
                    } else {
                        if (!$('#' + key).val()) {
                            $('#' + key).addClass('is-invalid');
                        }
                    }
                });
            }

        });
    });

    /*
         DELETE a link and remove from the page
    */
    $('.delete-user').click(function () {
            var user_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: 'users/' + user_id,
                success: function (data) {
                    console.log(data);
                    $("#user" + user_id).remove();
                    $('#users-table').load(location.href+' #users-table>*','').hide().fadeIn(800);
                },
                error: function (data) {
                    console.log(data);
                }
            });
    });


});

$('#userFormData input').on('keyup', function () {
    $(this).removeClass('is-invalid').addClass('is-valid');
});