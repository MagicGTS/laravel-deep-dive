const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]).sourceMaps(true, 'source-map') 
    .vue()
    .webpackConfig(require('./webpack.config'));
mix.webpackConfig({
    devtool: 'inline-source-map'
});
mix.copy('resources/img', 'public/img', false);
if (mix.inProduction()) {
    mix.version();
}
mix.browserSync({ host: '172.16.26.136', proxy: '192.168.10.2', port: 3000, open: false, });
