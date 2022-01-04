const mix = require('laravel-mix');

mix.disableSuccessNotifications()
mix.options({
    terser: {
        extractComments: false,
    },
})
mix.setPublicPath('dist')
mix.setResourceRoot('/humaidem/map-picker')
mix.sourceMaps()
mix.version()

mix.js('resources/js/map-picker.js', 'dist/humaidem/map-picker')
mix.postCss('resources/css/map-picker.css', 'dist/humaidem/map-picker').options({
    processCssUrls: false
})
