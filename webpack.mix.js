const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public/modules/core').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/app.js')
    .js(__dirname + '/Resources/assets/js/theme.js', 'js/theme.js')
    .sass( __dirname + '/Resources/assets/scss/app.scss', 'css/app.css')
    .copyDirectory(__dirname + '/Resources/assets/img', '../../public/modules/core/img');

if (mix.inProduction()) {
    mix.version();
}
