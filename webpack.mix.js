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

mix.styles([
    'public/css/linearicons.css',
    'public/css/themify-icons.css',
    'public/css/owl.carousel.css',
    'public/css/nice-select.css',
    'public/css/ion.rangeSlider.css',
    'public/css/ion.rangeSlider.skinFlat.css',
    'public/css/magnific-popup.css',
    'public/css/custom/custom.css',
], 'public/css/app.css');

mix.styles([
    'public/css/font-awesome.min.css',
    'public/css/nouislider.min.css',
], 'public/css/app.min.css');

mix.styles([
    'public/css/bootstrap.css',
], 'public/css/bootstrap.css',);

mix.styles([
    'public/css/main.css'
], 'public/css/main.css');


mix.scripts([
    'public/js/vendor/jquery-2.2.4.min.js',
    'public/js/vendor/bootstrap.min.js',
    'public/js/vendor/popper.min.js',
    'public/js/jquery.ajaxchimp.min.js',
    'public/js/jquery.nice-select.min.js',
    'public/js/nouislider.min.js',
    'public/js/jquery.magnific-popup.min.js',
    'public/js/owl.carousel.min.js',
    'public/js/gmaps.min.js',
    'public/js/jquery.sticky.js',
    'public/js/main.js',
    'public/js/selfjs/users.js',
    'public/js/selfjs/cart.js',
    'public/js/selfjs/update_quantity.js',
    'public/js/selfjs/orders.js',
    'public/js/selfjs/rate.js',
], 'public/js/app.min.js');
