jQuery(document).ready(function ($) {
    let queues = [];
    load();
    getQueues();
    // setProjectsUser();
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
            setProjectsUser()
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function setProjectsUser() {
    let projects = '';
    console.log(queues);
    $.each(user_projects, function (index, element) {

        if (queues[element] !== undefined) {
            projects += '<div class="row" style="padding: 5px;">\n' +
                '                                                    <div class="card component-card_4">\n' +
                '                                                        <div class="card-body">\n' +
                '                                                            <div class="user-profile">\n' +
                '                                                            </div>\n' +
                '                                                            <div class="user-info" style="margin-top: 0!important">\n' +
                '                                                                <div class="card-star_rating">\n' +
                '                                                                    <span class="badge badge-primary">' + element + '</span>\n' +
                '                                                                    <h5 class="card-user_name project">' + queues[element].name_display + '</h5>\n' +
                '                                                                </div>\n' +
                '                                                            </div>\n' +
                '                                                        </div>\n' +
                '                                                    </div>\n' +
                '                                                </div>';
        }

    });
    console.log( $('#projects'));
    $('#projects').html(projects);
}
