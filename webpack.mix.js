
let mix = require('laravel-mix');
mix.setPublicPath('assets');
const path = require('path');
mix.webpackConfig({
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'src/admin'),
        '@components': path.resolve(__dirname, 'src/admin/components'),
        '@pages': path.resolve(__dirname, 'src/admin/pages') 
      },
    },
  });


mix.setResourceRoot('../');
mix
    .js('src/js/boot.js', 'assets/js/boot.js')
    .js('src/js/main.js', 'assets/js/plugin-main-js-file.js').vue({ version: 2 })
    .js('src/js/public/lmt_public.js', 'assets/js/lmt_public.js')
    .copy('src/images', 'assets/images')
    .sass('src/scss/admin/app.scss', 'assets/css/element.css')
    .sass('src/scss/public/lmt_public.scss', 'assets/css/lmt_public.css')
    .sass('src/scss/public/borrow_book/borrow_index.scss', 'assets/css/borrow_books.css')
     
