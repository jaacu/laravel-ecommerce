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
      // Theme js
      // .js('resources/assets/minimal/js/custom.js', 'public/js')
      .js('resources/assets/minimal/js/jquery.slimscroll.js', 'public/js')
      .js('resources/assets/minimal/js/waves.js', 'public/js')
      // .js('resources/assets/minimal/js/validation.js', 'public/js')
      .js('resources/assets/minimal/js/sidebarmenu.js', 'public/js')
      .js('resources/assets/minimal/js/jquery.PrintArea.js', 'public/js')
      //plugins
      .js('resources/assets/assets/plugins/jquery/jquery.min.js', 'public/js')
      .js('resources/assets/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js', 'public/js')
      .js('resources/assets/assets/plugins/bootstrap-select/bootstrap-select.min.js', 'public/js')
      .js('resources/assets/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js', 'public/js')
      .js('resources/assets/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js', 'public/js')
      .js('resources/assets/assets/plugins/multiselect/js/jquery.multi-select.js', 'public/js')
      .js('resources/assets/assets/plugins/select2/dist/js/select2.min.js', 'public/js')
      //Custom js and Laravel default js
      .js('resources/assets/js/app.js', 'public/js')
      .js('resources/assets/js/customMain.js', 'public/js')
      //Theme scss
      .sass('resources/assets/minimal/scss/style.scss', 'public/css/template.css')
      //Theme colors scss
      .sass('resources/assets/minimal/scss/colors/blue-dark.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/blue.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/default-dark.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/default.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/green-dark.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/green.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/megna-dark.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/megna.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/purple-dark.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/purple.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/red-dark.scss', 'public/css/colors')
      .sass('resources/assets/minimal/scss/colors/red.scss', 'public/css/colors')
      //Plugins css
      .styles('resources/assets/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css', 'public/css/bootstrap-datepicker.min.css')
      .styles('resources/assets/assets/plugins/bootstrap-select/bootstrap-select.min.css', 'public/css/bootstrap-select.min.css')
      .styles('resources/assets/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css', 'public/css/bootstrap-tagsinput.css')
      .styles('resources/assets/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css', 'public/css/jquery.bootstrap-touchspin.min.css')
      .styles('resources/assets/assets/plugins/multiselect/css/multi-select.css', 'public/css/multi-select.css')
      .styles('resources/assets/assets/plugins/bootstrap/css/bootstrap.min.css', 'public/css/bootstrap.min.css')      
      .styles('resources/assets/assets/plugins/select2/dist/css/select2.min.css', 'public/css/select2.min.css')      
      .styles('resources/assets/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css', 'public/css/ion.rangeSlider.css')      
      .styles('resources/assets/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinModern.css', 'public/css/ion.rangeSlider.skinModern.css') 
      .styles('resources/assets/assets/plugins/wizard/steps.css', 'public/css/steps.css')
      .styles('resources/assets/assets/plugins/sweetalert/sweetalert.css', 'public/css/sweetalert.css')
      .styles('resources/assets/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css', 'public/css/magnific-popup.css')
      // Laravel default scss
      .sass('resources/assets/sass/app.scss', 'public/css/app.css')
      //Custom scss
      .sass('resources/assets/sass/custom.scss', 'public/css/custom.css');
      