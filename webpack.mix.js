let mix = require('laravel-mix');
require('laravel-mix-purgecss');
require('mix-tailwindcss');

mix.setResourceRoot('packages/protoqol/prequel')
    .postCss('resources/assets/css/app.css', 'public')
    .purgeCss()
    .tailwind()
    .js('resources/assets/js/app.js', 'public')
    .vue({ version: 2 })
    .copy('public', '../BlankLaravel/public/vendor/prequel')
    .copy('resources/lang', '../BlankLaravel/resources/lang/vendor/prequel');

