/**
 * Register global js namespace,
 * and runs DOM ready scripts based on routes configuration
 *
 * @author True Agency
 * @url http://trueagency.com.au
 */

var App = {};
window.App = App;

/**
 * Run scripts based on routes.js configuration.
 * All are fired on document ready.
 *
 * @param  jQuery       $
 * @param  Window.App   App
 * @return void
 */
;(function ($, App) {

    $(document).ready(function () {
        for (var key in App.Routes) {
            if (key === 'init' || $(key).length) {
                App.Routes[key].init()
            }
        }
    });

})(jQuery, window.App);
