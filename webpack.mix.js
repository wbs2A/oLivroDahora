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

mix.js('resources/js/app.js', 'public/js');
    mix.js("resources/js/availability-calendar.js", "public/js");
    mix.js("resources/js/bootstrap.js", "public/js");
    mix.js("resources/js/vendor/bootstrap.min.js", "public/js/vendor");
    mix.js("resources/js/vendor/jquery-2.2.4.min.js", "public/js/vendor");
    mix.js("resources/js/bootstrap-datepicker.js", "public/js");
    mix.js("resources/js/isotope.pkgd.min.js", "public/js");
    mix.js("resources/js/botwidget.js", "public/js");
    mix.js("resources/js/jquery.ajaxchimp.min.js", "public/js");
    mix.js("resources/js/jquery.magnific-popup.min.js", "public/js");
    mix.js("resources/js/jquery.nice-select.min.js", "public/js");
    mix.js("resources/js/jquery.sticky.js", "public/js");
    mix.js("resources/js/jquery.tabs.min.js", "public/js");
    mix.js("resources/js/main.js", "public/js");
    mix.js("resources/js/owl.carousel.min.js", "public/js");
    mix.js("resources/js/owl-carousel-thumb.min.js", "public/js");
    mix.js("resources/js/parallax.min.js", "public/js");
    mix.js("resources/js/register.js", "public/js");
    mix.js("resources/js/categoria.js", "public/js");
    mix.js("resources/js/index.js", "public/js");
    mix.js("resources/js/post.js", "public/js");
    mix.js("resources/js/dashboard.js", "public/js");
    mix.js("resources/js/jquery.mask.js", "public/js");
    mix.js("resources/js/staticSideBar.js", "public/js")
   .sass('resources/sass/app.scss', 'public/css');
