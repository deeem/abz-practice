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
 */

mix.js([
  'resources/assets/js/app.js',
  'node_modules/select2/dist/js/select2.js'
], 'public/js/vendor.js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts([
  'resources/assets/js/employee-form.js',
  'resources/assets/js/employee-table.js',
  'resources/assets/js/lazy-tree.js',
  'resources/assets/js/navbar-active.js'
], 'public/js/app.js');
