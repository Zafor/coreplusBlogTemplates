;(function (window, $, App) {

    'use strict';

    /**
     * Register the pair of selector and class to instantiate scripts
     * e.g. {
     *     // Will execute App.Home.init() if 'body.home' is found on page
     *     'body.home' : App.Home
     * }
     */

    var self = App.Routes = {
        // Fired in all pages
        'init': App.Common,

        // Page-level scripts
        // 'body.home': App.Home.init,

        // Component levels
    };

})(window, jQuery, App);
