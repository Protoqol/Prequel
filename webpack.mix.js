const mix                = require('laravel-mix')
const MonacoEditorPlugin = require('monaco-editor-webpack-plugin')

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
  webpackConfig({
    plugins: [
      new MonacoEditorPlugin({
        languages: ['sql'],
        features: ['!gotoSymbol']
      }),
    ],
  }).
  postCss('resources/assets/css/app.css', 'public', [
    require('tailwindcss'),
  ]).
  js('resources/assets/js/app.js', 'public').
  copy('public', '../../../public/vendor/prequel').
  copy('resources/lang', '../../../resources/lang/vendor/prequel').
  options({
    purifyCss: true,
  })
