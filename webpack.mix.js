const mix = require("laravel-mix");

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

mix.js(["resources/js/app.js", "resources/js/scripts.js"], "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .styles(
        [
            "resources/styles/animate.css",
            "resources/styles/accordions.css",
            "resources/styles/alerts.css",
            "resources/styles/buttons.css",
            "resources/styles/nalika-icon.css",
            "resources/styles/font-awesome.min.css",
            "resources/styles/meanmenu.min.css",
            "resources/styles/style.css"
        ],
        "public/css/all.css"
    );
