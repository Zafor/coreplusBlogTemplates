var 
    BaseTask = require('./base'),
    gulp     = require('gulp'),
    fs       = require('fs'),
    notify   = require('gulp-notify'),
    gulpif   = require('gulp-if'),
    lib      = require('./../lib'),
    gutil    = require('gulp-util')
;

var SolidVersion = function (options, config) {
    this._config  = config
    this._options = options
    this._to      = null
    this._after   = 'default'
}

SolidVersion.prototype = new BaseTask;
SolidVersion.prototype.constructor = SolidVersion

SolidVersion.prototype.randVersion = function(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

SolidVersion.prototype.to = function(to) {
    var self = this
    this._to = to
    var isLocal = this._config.isLocal
    var target  = this.determineTarget(to)

    fs.writeFileSync(target, '{ "version": '+ this.randVersion(1001, 50000) +' }');

    var fancyMessage = gutil.colors.green('New asset version') + ' written to ' + target;
    gutil.log(fancyMessage);

    return this
}

module.exports = exports = SolidVersion;
