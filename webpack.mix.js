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
mix.sass('core/Styles/admin/scss/main.scss', 'public/assets/admin')
     .js('core/Styles/admin/js/main.js', 'public/assets/admin');


mix.sass('resources/scss/login.scss', 'public/assets');


mix.version();
