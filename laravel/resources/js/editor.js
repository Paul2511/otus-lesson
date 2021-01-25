var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],

    ['clean']                                         // remove formatting button
];

hljs.configure({   // optionally configure hljs
    languages: ['javascript', 'php']
});

var quillOptions = {
    modules: {
        syntax: true,              // Include syntax module
        toolbar: toolbarOptions  // Include button in toolbar
    },
    theme: 'snow'
};

$(document).ready(function () {
    $(".visRedactor").each(function () {
        var name = $(this).data('name');
        var selector =  $(this).data('selector');

        window['quill' + name] = new Quill(".visRedactor[data-name='" + name + "']", quillOptions);
        window['quill' + name].on('text-change', function(delta, oldDelta, source) {
            var html = $( ".visRedactor[data-name='" + name + "'] .ql-editor").html();
            $(selector).val(html);
        });
    });
});
