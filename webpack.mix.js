const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
        'node_modules/bootstrap.dist/css/bootstrap.min.css',
        'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'
        'public/css/app.css'
    ], 'public/css/app.css')
   // .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')
   .browserSync('https://crud.test');
