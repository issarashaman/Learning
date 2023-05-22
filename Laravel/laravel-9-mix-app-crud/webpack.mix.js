const mix = require('laravel-mix');

//mix.disableSuccessNotifications();
mix.disableNotifications();

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .alias({
        '@': 'resources/js',
    });

mix.js('resources/vue/main.js', 'public/js/console.js')
    .vue()
    .sass('resources/sass/console.scss', 'public/css/console.css')
    .alias({
        '@': 'resources/vue',
    });

if (mix.inProduction()) {
  // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
  // .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
  mix.version();
} else {
  mix.sourceMaps();
}
