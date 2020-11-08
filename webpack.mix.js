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

/*mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);*/

mix.styles([
    'resources/assets/frontend/css/animate-3.7.0.css',
    'resources/assets/frontend/css/font-awesome-4.7.0.min.css',
    'resources/assets/frontend/fonts/flat-icon/flaticon.css',
    'resources/assets/frontend/css/bootstrap-4.1.3.min.css',
    'resources/assets/frontend/css/owl-carousel.min.css',
    'resources/assets/frontend/css/nice-select.css',
    'resources/assets/frontend/css/style.css',
], 'public/css/frontend.css').version();

mix.scripts([
    'resources/assets/frontend/js/vendor/jquery-2.2.4.min.js',
    'resources/assets/frontend/js/vendor/bootstrap-4.1.3.min.js',
    'resources/assets/frontend/js/vendor/wow.min.js',
    'resources/assets/frontend/js/vendor/owl-carousel.min.js',
    'resources/assets/frontend/js/vendor/jquery.nice-select.min.js',
    'resources/assets/frontend/js/vendor/ion.rangeSlider.js',
    'resources/assets/frontend/js/main.js',
], 'public/js/frontend.js').version();

mix.copy('resources/assets/frontend/images', 'public/images');
mix.copy('resources/assets/frontend/fonts', 'public/fonts');

