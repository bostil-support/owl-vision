const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const glob = require('glob-all')

if (mix.inProduction()) {
  mix.version();
}

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
  .sass('resources/sass/site/app.scss', 'public/css')

  // admin
  .js('resources/js/admin/admin.js', 'public/js/admin')
  .sass('resources/sass/admin/admin.scss', 'public/css/admin')

  .options({
    processCssUrls: false,
    postCss: [
      tailwindcss('resources/js/tailwind.config.js'),
      require('autoprefixer')
    ],
    // extractVueStyles: false,
    // uglify: {},
    // purifyCss: true,
    purifyCss: {
      moduleExtensions: ['php', 'vue', 'js'],
      paths: glob.sync([
        path.join(__dirname, 'resources/**/*.blade.php'),
        path.join(__dirname, 'resources/**/*.vue'),
        path.join(__dirname, 'resources/**/*.js')
      ]),
      purifyOptions: {
      //   whitelist: [
      //     'active', '*dropdown-content*', '*select-dropdown*', '*select-wrapper*', 'material-icons', '*material-icons.mi*', 'toast', 'progress*',
      //     '*waves-light', '*type=checkbox*', '*switch*', 'loader*', '*chip*', '*indicators*', '*ymaps*', 'sidenav-overlay'
      //   ],
      //   rejected: true
      }
    },
    // clearConsole: false
  })

  .browserSync({
    proxy: process.env.MIX_APP_URL.split('://')[1],
    open: false,
    host: process.env.MIX_APP_URL.split('://')[1],
    "watchOptions": {
      usePolling: true
    },
  });
