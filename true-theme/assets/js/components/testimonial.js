/*
 * Testimonials Tooltip
 */

+function ($) { "use strict";

    // Testimonials CLASS DEFINITION
    // ============================

    var Testimonials = function(element, options) {
        var self         = this;
        this.options     = options;
        this.el          = element;
        this.$el         = $(element);
        this.init();
    }

    Testimonials.DEFAULTS = {
        placement: 'top'
    }

    /**
     * On Init
     */
    Testimonials.prototype.init = function() {
        let instance = tippy('[data-testimonial-id="'+ this.options.testimonialId +'"]', {
            content: (reference) => {
                // const id = reference.getAttribute('data-template');
                // const template = document.getElementById(id);
                return $(`#${this.options.template}`).html();
            },
            trigger: 'click',
            placement: this.options.placement,
            hideOnClick: 'toggle',
            theme: 'light',
            flip: false,
            animation: 'scale',
            allowHTML: true,
            zIndex: 999 // 1 lower than header
        })[0];
        if (this.options.autoExpand && TrueLib.windowWidth() > 768) {
            instance.show()
        }
        $(window).on('resize', () => {
            instance.hide()
        })
    }

    // Testimonials PLUGIN DEFINITION
    // ============================

    $.fn.testimonials = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('trueper.testimonials')
            var options = $.extend({}, Testimonials.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('trueper.testimonials', (data = new Testimonials(this, options)))
            else if (typeof option == 'string') data[option].apply(data, args)
        })
    }

    $.fn.testimonials.Constructor = Testimonials

    // DeleteActivity DATA-API
    // ===============

    $(document).on('ready', function () {
        $('[data-control="testimonials"]').testimonials();
    });

}(window.jQuery);
