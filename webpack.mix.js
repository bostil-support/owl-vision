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

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '~': path.join(__dirname, './resources/js')
    }
  }
});

mix
  // site
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')

  // admin
  .js('resources/js/admin/admin.js', 'public/js/admin')
  .sass('resources/sass/admin/admin.scss', 'public/css/admin')

  .browserSync({
    proxy: process.env.MIX_APP_URL.split('://')[1],
    open: false,
    host: process.env.MIX_APP_URL.split('://')[1],
    "watchOptions": {
      usePolling: true
    },
  });
