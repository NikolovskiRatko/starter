const mix = require('laravel-mix');
const path = require('path');
const TerserPlugin = require('terser-webpack-plugin');
const HardSourceWebpackPlugin = require('hard-source-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const PurgecssPlugin = require('purgecss-webpack-plugin');
const glob = require('glob-all');
require('laravel-mix-purgecss');

const webpackConfig = {
    devtool: mix.inProduction() ? '' : 'inline-source-map',
    module: {
        rules: [
            {
                test: /\.js$/,
                include: [
                    path.resolve(__dirname, 'node_modules/vue-socialmedia-share'),
                    path.resolve(__dirname, 'node_modules/vue2-google-maps'),
                    path.resolve(__dirname, 'node_modules/vuejs-datepicker'),
                ],
                use: [
                    {
                        loader: 'babel-loader',
                        options: Config.babel()
                    }
                ]
            },
            {
                test: /\.ts(x?)$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: Config.babel()
                    },
                    {
                        loader: 'ts-loader',
                        options: {
                            appendTsSuffixTo: [/\.vue$/],
                            transpileOnly: true
                        },
                    }
                ]
            },
        ]
    },
    resolve: {
        extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx', '.css', '.scss', '.sass'],
        alias: {
            'vue$': (process.env.NODE_ENV !== 'production')? 'vue/dist/vue.esm.js': 'vue/dist/vue.runtime.esm.js',
            styles: path.resolve(__dirname, 'resources/assets/sass'),
            '@': path.resolve(__dirname, 'resources/assets/vue'),
        }
    },
    plugins: [
        new HardSourceWebpackPlugin({
            environmentHash: {
                root: process.cwd(),
                directories: [],
                files: ['package-lock.json', 'yarn.lock', 'package.json']
            },
            // Clean up large, old caches automatically.
            cachePrune: {
                // Caches younger than `maxAge` are not considered for deletion. They must
                // be at least this (default: 2 days) old in milliseconds.
                maxAge: 5 * 24 * 60 * 60 * 1000,
                // All caches together must be larger than `sizeThreshold` before any
                // caches will be deleted. Together they must be at least this
                // (default: 50 MB) big in bytes.
                sizeThreshold: 200 * 1024 * 1024
            }
        }),
        // You can optionally exclude items that may not be working with HardSource
        // or items with custom loaders while you are actively developing the
        // loader.
        new HardSourceWebpackPlugin.ExcludeModulePlugin([
            {
                // HardSource works with mini-css-extract-plugin but due to how
                // mini-css emits assets, assets are not emitted on repeated builds with
                // mini-css and hard-source together. Ignoring the mini-css loader
                // modules, but not the other css loader modules, excludes the modules
                // that mini-css needs rebuilt to output assets every time.
                test: /mini-css-extract-plugin[\\/]dist[\\/]loader/,
            }
        ]),
    ],
};

const webpackOptions = {
    processCssUrls: false,
    purifyCss: false,
    extractVueStyles: false,
    imgLoaderOptions: {
        enabled: false
    },
    entry: {
        app: './js/app.js',
        app_admin: './js/app_admin.js'//tried to enable multiple entry points for webpack but it does not seem to be supported
    },
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: '[name].js',
    },
    optimization: {
        minimizer: [
            new TerserPlugin({
                chunkFilter: () => true,
                parallel: 4,
            }),

            new OptimizeCSSAssetsPlugin({
                assetNameRegExp: /\.optimize\.css$/g,
                cssProcessor: require('cssnano'),
                cssProcessorPluginOptions: {
                    preset: ['default', { discardComments: { removeAll: true } }],
                },
                canPrint: true
            })
        ],

        runtimeChunk: 'single',
        splitChunks: {//This whole section has no effect
            chunks: 'all',
            maxInitialRequests: Infinity,
            minSize: 0,
            cacheGroups: {
                vendor: {
                    // chunks: 'initial',
                    // name: 'vendor',
                    // filename: 'vendor.js',
                    test: /[\\/]node_modules[\\/]/,
                    name(module) {
                        // get the name. E.g. node_modules/packageName/not/this/part.js
                        // or node_modules/packageName
                        const packageName = module.context.match(/[\\/]node_modules[\\/](.*?)([\\/]|$)/)[1];

                        // npm package names are URL-safe, but some servers don't like @ symbols
                        return `npm.${packageName.replace('@', '')}`;
                    },
                },
            },
        },
    },
};

//this seems to have no effect
module.exports = {
    plugins: [
        new MiniCssExtractPlugin({
            // Options similar to the same options in webpackOptions.output
            // all options are optional
            filename: '[name].css',
            chunkFilename: '[id].css',
            ignoreOrder: false, // Enable to remove warnings about conflicting order
        }),
    ],
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            // you can specify a publicPath here
                            // by default it uses publicPath in webpackOptions.output
                            // publicPath: '../',
                            hmr: process.env.NODE_ENV === 'development',
                        },
                    },
                    'css-loader',
                ],
            },
        ],
    },
};

mix.disableSuccessNotifications();
mix.sourceMaps();
mix.version();

mix
.options(webpackOptions)
.sass('resources/assets/sass/app.scss', 'public/css')
.sass('resources/assets/sass/app-admin.scss', 'public/css')
.js('resources/assets/vue/app.ts', 'public/js')
// .js('resources/assets/vue/app_admin.ts', 'public/js')//This breaks sass to css compilation
.copyDirectory('resources/assets/fonts', 'public/fonts')
.webpackConfig(webpackConfig)
.purgeCss({
    enabled: mix.inProduction(),
    // Your custom globs are merged with the default globs. If you need to
    // fully replace the globs, use the underlying `paths` option instead.
    globs: [
        path.join(__dirname, 'node_modules/simplemde/!**!/!*.js'),
    ],
    // customSyntax: path.join(__dirname, '/node_modules/postcss-sass'),
    extensions: ['html', 'js', 'php', 'vue'],
    // Other options are passed through to Purgecss
    whitelistPatterns: [/language/, /hljs/,/^hooper-/,/^slick-/,/^pswp/],
    whitelistPatternsChildren: [/^markdown$/,/^hooper-/,/^slick-/,/^pswp/],
    whitelist: ['custom-control-input'],
});
