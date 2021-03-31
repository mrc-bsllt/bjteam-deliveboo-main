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

mix.js('resources/js/app.js', 'public/js').vue({ version: 2 })
  .js('resources/js/partials/layouts/backend.js', 'public/js/partials/layouts').vue({ version: 2 })
  .js('resources/js/partials/layouts/frontend.js', 'public/js/partials/layouts').vue({ version: 2 })
  .js('resources/js/partials/guest/homepage.js', 'public/js/partials/guest').vue({ version: 2 })
  .js('resources/js/partials/guest/menu-restaurant.js', 'public/js/partials/guest').vue({ version: 2 })
  .js('resources/js/partials/guest/success.js', 'public/js/partials/guest').vue({ version: 2 })
  .sass('resources/sass/style.scss', 'public/css')
  .sass('resources/sass/app.scss', 'public/css')
  .sass('resources/sass/partials/guests/style-guest.scss', 'public/css');
