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

mix.setResourceRoot('packages/protoqol/prequel').
    postCss('resources/assets/css/app.css', 'public', [
      require('tailwindcss'),
    ]).
    js('resources/assets/js/app.js', 'public').
    copy('public', '../../../public/vendor/prequel').
    copy('resources/lang', '../../../resources/lang/vendor/prequel').
    browserSync({
      proxy: 'https://prequeltest.dev',
    }).
    options({
      purifyCss: true,
    });
