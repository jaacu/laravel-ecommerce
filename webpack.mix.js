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

mix.js('resources/assets/minimal/js/custom.min.js', 'public/js')
      // .js('resources/assets/minimal/js/custom.js', 'public/js')
      .js('resources/assets/minimal/js/jquery.slimscroll.js', 'public/js')
      .js('resources/assets/minimal/js/waves.js', 'public/js')
      .js('resources/assets/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js', 'public/js')
      // .js('resources/assets/minimal/js/validation.js', 'public/js')
      .js('resources/assets/minimal/js/sidebarmenu.js', 'public/js')
      .js('resources/assets/js/customMain.js', 'public/js')
      .sass('resources/assets/minimal/scss/style.scss', 'public/css/template.css')
      .sass('resources/assets/sass/custom.scss', 'public/css/custom.css');
