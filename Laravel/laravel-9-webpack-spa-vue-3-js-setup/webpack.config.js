const path = require("path");
const HtmlWebpackPlugin = require("html-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { WebpackManifestPlugin } = require("webpack-manifest-plugin");
const { VueLoaderPlugin } = require("vue-loader");
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')

const toml = require("toml");
const yaml = require("yamljs");
const json5 = require("json5");

module.exports = {
    mode: "development",
    entry: {
        app: "./resources/app.js",
        bootstrap: "./resources/bootstrap.js",
    },
    devtool: "inline-source-map",
    optimization: {
        splitChunks: {
            cacheGroups: {
                styles: {
                    name: "app.styles",
                    type: "css/mini-extract",
                    chunks: "all",
                    enforce: true,
                },
                vendor: {
                  test: /[\\/]node_modules[\\/]/,
                  name: 'vendors',
                  chunks: 'all',
                },
            },
        },
    },
    plugins: [
        new WebpackManifestPlugin(),
        new VueLoaderPlugin(),
        new MiniCssExtractPlugin({
            // Options similar to the same options in webpackOptions.output
            // both options are optional
            filename: "css/[name].css",
        }),
        new BrowserSyncPlugin({
          // browse to http://localhost:3000/ during development,
          // ./public directory is being served
          host: 'localhost',
          port: 3000,
          //server: { baseDir: ['public'] },
          proxy: 'http://localhost:8000/'
        },
        // plugin options
        {
          // prevent BrowserSync from reloading the page
          // and let Webpack Dev Server take care of this
          reload: true
        })
    ],
    output: {
        filename: "js/[name].bundle.js",
        path: path.resolve(__dirname, "public/dist"),
        clean: true,
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
            {
                test: /\.s[ac]ss$/i,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: "css-loader",
                        options: {
                            sourceMap: false,
                        },
                    },
                    {
                        loader: "sass-loader",
                        options: {
                            sourceMap: false,
                        },
                    },
                ],
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: "asset/resource",
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: "asset/resource",
            },
            {
                test: /\.vue$/,
                loader: "vue-loader",
            },
        ],
    },
};
