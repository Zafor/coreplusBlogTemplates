/*
 * Plans Block Form Plugin
 *
 *
 */

+function ($) { "use strict";

    // PlansBlock CLASS DEFINITION
    // ============================

    var PlansBlock = function(element, options) {
        var self         = this;
        this.options     = options;
        this.el          = element;
        this.$el         = $(element);

        this.$boxes      = this.$el.find('.plan-block-item');

        //this.init();
    }

    PlansBlock.DEFAULTS = { }

    /**
     * On Init
     *
     */
    PlansBlock.prototype.init = function() {
        var self = this;
    }

    // PlansBlock PLUGIN DEFINITION
    // ============================

    $.fn.plansBlock = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('trueper.newsletter-signup')
            var options = $.extend({}, PlansBlock.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('trueper.newsletter-signup', (data = new PlansBlock(this, options)))
            else if (typeof option == 'string') data[option].apply(data, args)
        })
    }

    $.fn.plansBlock.Constructor = PlansBlock

    // DeleteActivity DATA-API
    // ===============

    $(document).on('ready', function () {
        $('[data-control="plans-block"]').plansBlock();
    });

}(window.jQuery);
