const mix = require('laravel-mix');

// Compilar el archivo app.js a public/js
mix.js('resources/js/app.js', 'public/js')

// Compilar app.css y otros archivos CSS
mix.postCss('resources/css/app.css', 'public/css', [
    //
]);


