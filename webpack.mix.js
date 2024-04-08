const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .react('resources/js/CryptoList.js', 'public/js')
   .react('resources/js/CryptoBasket.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
