const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .react() // Enable React support
   .webpackConfig({
       module: {
           rules: [
               {
                   test: /\.(js|jsx)$/,
                   exclude: /node_modules/,
                   use: {
                       loader: 'babel-loader',
                       options: {
                           presets: ['@babel/preset-env', '@babel/preset-react']
                       }
                   }
               }
           ]
       },
       resolve: {
           extensions: ['.js', '.jsx']
       }
   })
   .sass('resources/sass/app.scss', 'public/css');
