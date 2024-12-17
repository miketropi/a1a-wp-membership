const mix = require('laravel-mix');

mix
  .js('./src/main.js', './dist/a1a-membership.bundle.js')
  .react()
  .sass('./src/scss/main.scss', 'css/a1a-membership.bundle.css')
  .setPublicPath('dist')