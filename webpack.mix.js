const mix = require('laravel-mix');

if (mix.inProduction()) {
  mix.version();
}

mix.options({
  // extractVueStyles: false,
  // processCssUrls: true,
  // uglify: {},
  // purifyCss: false,
  // purifyCss: {},
  postCss: [require('autoprefixer')],
  // clearConsole: false
});

mix
  // site
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')

  // admin
  .js('resources/js/admin/admin.js', 'public/js/admin')
  .sass('resources/sass/admin/admin.scss', 'public/css/admin')

  .browserSync({
    proxy: 'localhost:8000',
    open: false,
    host: 'localhost',
    "watchOptions": {
      usePolling: true
    },
  });
