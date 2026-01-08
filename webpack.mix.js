const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue()
    .setResourceRoot('/bs-nursing/')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer'),
    ]);
const tailwindcss = require('tailwindcss')

mix.sass('resources/sass/app.scss', 'public/css')
   .options({
      processCssUrls: false,
      postCss: [ tailwindcss('tailwind.config.js') ],
})
