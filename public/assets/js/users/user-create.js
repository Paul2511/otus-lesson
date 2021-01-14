jQuery(document).ready(function ($) {

    let queues = [];
    load();
    // getResources();
    // getQueues();
    $('#add-project').click(function (e) {
        e.preventDefault();
    });
});

$('#save-changes').click(function (e) {
    e.preventDefault();
    let full_name = $('#fullName').val();
    let phone = $('#phone').val();
    let password = $('#password').val();
    let email = $('#email').val();
    let is_admin = 0;

    if($("#is_admin").prop('checked')) {
         is_admin = 1;
    }
    console.log(is_admin);

    var idx = user_projects.indexOf(7150);
    if (idx == -1) {
        user_projects.push(7150);
    }

    var idx2 = user_resources.indexOf(3);
    if (idx2 == -1) {
        user_resources.push(3);
    }

    $.ajax({
        type: 'POST',
        beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
        },  // Add this line
        url: route_store,
        data: {full_name: full_name, phone:phone, is_admin:is_admin, password: password, email:email, resources: user_resources, projects: user_projects},
        dataType: 'json',
        success: function (respond) {


            Snackbar.show({
                text: 'Сохранено успешно',
                actionTextColor: '#fff',
                backgroundColor: '#8dbf42',
                pos: 'top-right',
                actionText: "Закрыть",
            });
            window.location.href = location_good;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            let error_message = '';
            if (jqXHR.responseText !== undefined)
            {
                $.each(JSON.parse(jqXHR.responseText).errors, function (index, element) {
                    error_message +=element + ', ';
                });
            }
            Snackbar.show({
                text: error_message,
                actionTextColor: '#fff',
                backgroundColor: '#e7515a',
                pos: 'top-right',
                actionText: "Закрыть",
            });
        }
    });
    console.log(user_resources);
    console.log(user_projects);
});

function load() {
    var block = $('#user_projects');
    $(block).block({
        message: $('#blockui-animation-container'),
        timeout: 3000, //unblock after 2 seconds
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            width: 36,
            height: 50,
            color: '#000',
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        },
        onBlock: function() {
            getQueues();
        }
    });

    var block_resources = $('#user_resources');
    $(block_resources).block({
        message: $('#blockui-animation-container1'),
        timeout: 2000, //unblock after 2 seconds
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            width: 36,
            height: 50,
            color: '#000',
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        },
        onBlock: function() {
            getResources();
        }
    });
}
function getResources() {
    $.ajax({
        type: 'POST',
        beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
        },  // Add this line
        url: '/resources',
        data: {},
        dataType: 'json',
        success: function (respond) {

            let resource = '';
            $.each(user_resources, function (index, element) {
                if (respond.resources[element] !== undefined) {
                    resource += '<div class="card">\n' +
                        '                                                            <div class="card-header" id="' + element + '" style="background-color: #ebfff0">' +
                        '                                                                <section class="mb-0 mt-0">\n' +
                        '                                                                    <div role="menu" style="color:#3b3f5c;" class="collapsed" data-toggle="collapse" data-target="#settingAccordion' + element + '" aria-expanded="true" \n' +
                        '                                                                         aria-controls="settingAccordion' + element + '">\n' +
                        '                                                                        ' + respond.resources[element].full_name + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                </section>\n' +
                        '                                                            </div>\n' +
                        '\n' +
                        '                                                            <div id="settingAccordion' + element + '" class="collapse" data-parent="#resources">\n' +
                        '                                                                <div class="card-body">\n' +
                        '                                                                    ' + respond.resources[element].description + '\n' +
                        '                                                                </div>\n' +
                        '                                                            </div>\n' +
                        '                                                        </div>';
                }

            });
            $.each(respond.resources, function (index, element) {
                if (user_resources.indexOf(element.id) == -1) {
                    resource += '<div class="card">\n' +
                        '                                                            <div class="card-header" id="' + element.id + '" style="background-color: ' +
                        ((user_resources.indexOf(element.id) != -1) ? '#ebfff0' : '#ffecec')
                        + '">\n' +
                        '                                                                <section class="mb-0 mt-0">\n' +
                        '                                                                    <div role="menu" style="color:#3b3f5c;" class="collapsed" data-toggle="collapse" data-target="#settingAccordion' + element.id + '" aria-expanded="true" \n' +
                        '                                                                         aria-controls="settingAccordion' + element.id + '">\n' +
                        '                                                                        ' + element.full_name + '\n' +
                        '                                                                    </div>\n' +
                        '                                                                </section>\n' +
                        '                                                            </div>\n' +
                        '\n' +
                        '                                                            <div id="settingAccordion' + element.id + '" class="collapse" data-parent="#resources">\n' +
                        '                                                                <div class="card-body">\n' +
                        '                                                                    ' + element.description + '\n' +
                        '                                                                </div>\n' +
                        '                                                            </div>\n' +
                        '                                                        </div>';
                }

                $('#resources').html(resource);
            });
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}


function getQueues() {
    $.ajax({
        type: 'POST',
        beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
        },  // Add this line
        url: '/queues',
        data: {},
        dataType: 'json',
        success: function (respond) {
            queues = respond.queues;
            setProjectsUser();
            setProjects();
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function setProjectsUser() {
    let projects = '';
    $.each(user_projects, function (index, element) {

        if (queues[element] !== undefined) {
            projects += '<div class="row" style="padding: 5px;">\n' +
                '                                                    <div class="card component-card_4">\n' +
                '                                                        <div class="card-body">\n' +
                '                                                            <div class="user-profile">\n' +
                '                                                            </div>\n' +
                '                                                            <div class="user-info">\n' +
                '                                                                <div class="card-star_rating">\n' +
                '                                                                    <span class="badge badge-primary">' + element + '</span>\n' +
                '                                                                    <h5 class="card-user_name project">' + queues[element].name_display + '</h5>\n' +
                '                                                                </div>\n' +
                '                                                                <p class="card-text"> Статусы: все </p>\n' +
                '                                                                <p class="card-text"> Базы: все </p>\n' +
                '                                                            </div>\n' +
                '                                                        </div>\n' +
                '                                                    </div>\n' +
                '                                                </div>';
        }

    });
    $('#projects').html(projects);
}



