const mix = require('laravel-mix');

mix.webpackConfig(
  { 
    resolve: { 
      fallback: { 
        "path": require.resolve("path-browserify"),
        "stream": require.resolve("stream-browserify"),
        "zlib": require.resolve("browserify-zlib"),
        "https": require.resolve("https-browserify"),
        "http": require.resolve("stream-http"),
        "crypto": require.resolve("crypto-browserify"),
        "vm": require.resolve("vm-browserify"),
        "os": require.resolve("os-browserify/browser"),
        "constants": require.resolve("constants-browserify"),
        '@swc/core/package.json' : false,
        'worker_threads' : false,
        'child_process': false,
        '@swc/core': false,
        'inspector': false,
        'esbuild' : false,
        'module' : false,
        "fs": false,
      }  
    }
  });


mix
     .sass('core/Styles/admin/scss/main.scss', 'public/assets/admin/css')
     .js('core/Styles/admin/js/main.js', 'public/assets/admin/js');


mix.sass('resources/scss/login.scss', 'public/assets');


mix.version();
