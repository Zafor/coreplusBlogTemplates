var solidPath = __dirname + '/lib/solid/';
var solid = require(solidPath + 'assets/build/solid-gulp');
var exec = require('child_process').exec;
var argv = require('yargs').argv
var isLocal = !argv.production

// Polyfill
require(solidPath + 'assets/build/polyfill');

//
// Configure solid
// ----------------------
solid
    .configure()
    .from(solidPath + 'assets/build/configs/wp.js')
    // Copy this from build/configs/sample.js
    .from(__dirname + '/assets/config.js')
    // .from(__dirname + '/gulp-build/config.js')

//
// Register tasks
// ----------------------
solid
    .sass('theme')
    .as('main.min.css')
    .message('Theme - Sass files completed')
    .watch()
    .to('css/')

solid
    .css('vendor')
    .as('vendor.min.css')
    .message('Vendor CSS - Combined')
    .watch()
    .to('css/')

solid
    .babel('app')
    .as('main.min.js')
    //.beautify()
    //.sourcemaps()
    .message('Application Javascript compiled')
    .watch()
    .to('js/dist/')

solid
    .concat('vendor')
    .as('vendor.min.js')
    //.beautify()
    //.sourcemaps()
    .message('Vendor javascript combined')
    .watch()
    .to('js/dist/');

solid
    .concat('combine_js')
    .as('packed.min.js')
    .message('Scripts Packed')
    .watch()
    .to('js/dist/')

// solid
//     .css('combine_css')
//     .as('packed.min.css')
//     .message('CSS Packed')
//     .watch()
//     .to('css/')

//
// Group tasks
// -------------------------
solid.task('default', [
    'sass.theme',
    'css.vendor',
    'babel.app',
    'concat.vendor',
    'concat.combine_js',
    // 'css.combine_css'
], function() {
    solid
        .version()
        .to('version.json')
    solid.start('concat.combine_js');
    if (isLocal) {
        exec('yarn tw', function (err, stdout, stderr) {
            console.log(stdout);
            console.log(stderr);
        });
    } else {
        exec('yarn tw:build', function (err, stdout, stderr) {
            console.log(stdout);
            console.log(stderr);
        });
    }
})
