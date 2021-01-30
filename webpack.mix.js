const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);


mix.styles([
    'resources/assets/main/css/fontawesome.min.css',
    'resources/assets/main/css/bootstrap.min.css',
    'resources/assets/main/css/mdb.min.css',
    'resources/assets/main/css/style.min.css',
], 'public/assets/main/css/main.css');

mix.styles([
    'resources/assets/main/css/landing.min.css',
], 'public/assets/main/css/landing.css');

mix.scripts([
    'resources/assets/main/js/jquery-3.4.1.min.js',
    'resources/assets/main/js/popper.min.js',
    'resources/assets/main/js/bootstrap.min.js',
    'resources/assets/main/js/mdb.min.js',
], 'public/assets/main/js/main.js');

mix.copyDirectory(
    'resources/assets/main/webfonts/fontawesome',
    'public/assets/main/webfonts'
);

mix.copyDirectory(
    'resources/assets/main/webfonts/roboto',
    'public/assets/main/font/robot'
);

mix.copyDirectory(
    'resources/assets/main/img',
    'public/assets/main/img'
);

mix.styles([
    'resources/assets/main/css/fontawesome.min.css',
    'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/admin/plugins/select2/css/select2.css',
    'resources/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css',
], 'public/assets/admin/css/admin.css');

mix.scripts([
    'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/main/js/bootstrap.min.js',
    'resources/assets/admin/plugins/select2/js/select2.full.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/demo.js',
], 'public/assets/admin/js/admin.js');

mix.copyDirectory(
    'resources/assets/admin/img',
    'public/assets/admin/img'
);

mix.copyDirectory(
    'resources/assets/admin/css/adminlte.min.css.map',
    'public/assets/admin/css/adminlte.min.css.map'
);
