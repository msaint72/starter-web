var Encore = require('@symfony/webpack-encore')

Encore
    .setOutputPath('public/build')
    .cleanupOutputBeforeBuild()
    .setPublicPath('/build')
    .disableSingleRuntimeChunk()
    .addEntry('js/app',[
        './node_modules/jquery/dist/jquery.slim.js',
        './node_modules/popper.js/dist/popper.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/holderjs/holder.min.js'
    ])
    .addStyleEntry('css/app',[
        './node_modules/bootstrap/dist/css/bootstrap.min.css',
        'assets/css/app.css'
    ])
    .enableSourceMaps(!Encore.isProduction())
;
module.exports = Encore.getWebpackConfig();