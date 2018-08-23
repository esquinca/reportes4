let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 mix.js('resources/assets/js/app.js', 'public/js')
 .sass('resources/assets/sass/app.scss', 'public/css');
 */

 mix.less('resources/assets/less/AdminLTE.less', 'public/css/style.css')
     .js('resources/assets/js/app.js', 'public/js/code_vue.js');
 mix.browserSync('http://dev.reportes.com/');
 mix.options({
     processCssUrls: false
});
