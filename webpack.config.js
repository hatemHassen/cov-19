
var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public_html/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .addEntry('back-js', './assets/back/js/main.js')
    .addEntry('front-js', './assets/front/js/main.js')
    .addEntry('home', './assets/front/js/views/home.js')
    .addStyleEntry('back-css', './assets/back/scss/admin.scss')
    .addStyleEntry('front-css', './assets/front/scss/front.scss')
    // Views
    .addEntry('js/dashboard', './assets/back/js/views/dashboard.js')
    .enableSassLoader()
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .enableSassLoader(function (sassOptions) {}, {resolve_url_loader: true})
    .configureBabel(function (babelConfig) {
        babelConfig.presets.push('es2017');
    })
    .autoProvidejQuery();

module.exports = Encore.getWebpackConfig();