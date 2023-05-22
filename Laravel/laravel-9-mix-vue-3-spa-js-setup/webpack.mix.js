/* eslint-disable no-undef */
const mix = require("laravel-mix");
const webpack = require("webpack");
const ESLintPlugin = require("eslint-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

mix.browserSync("http://localhost:8000");

//mix.disableSuccessNotifications();
mix.disableNotifications();

mix.webpackConfig({
  plugins: [
    new ESLintPlugin({
      fix: true,
      extensions: ["js", "vue"],
    }),
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: ["./js", "./css", "./fonts", "./images"],
    }),
    new webpack.DefinePlugin({
      __VUE_I18N_FULL_INSTALL__: true,
      __VUE_I18N_LEGACY_API__: false,
      __INTLIFY_PROD_DEVTOOLS__: false,
    }),
  ],
  resolve: {
    extensions: [".js", ".json", ".vue"],
    alias: {
      "@": __dirname + "/resources/demo-js",
    },
  },
  stats: {
    children: true,
  },
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/demo-js/app.js", "public/js").vue({ version: 3 }).sass("resources/sass/app.scss", "public/css");

if (mix.inProduction()) {
  // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
  // .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
  mix.version();
} else {
  mix.sourceMaps();
}
