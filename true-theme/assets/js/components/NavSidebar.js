/*
 * Nav Sidebar Plugin
 *
 *
 */

+function ($) { "use strict";

    
    function isOverlayTotallyScrolled() {
        // https://developer.mozilla.org/en-US/docs/Web/API/Element/scrollHeight#Problems_and_solutions
        return _overlay.scrollHeight - _overlay.scrollTop <= _overlay.clientHeight;
    }

    var _overlay = document.getElementsByClassName('floating-sidebar__content')[0];
    var _clientY = null; // remember Y position on touch start

    _overlay.addEventListener('touchstart', function (event) {
        if (event.targetTouches.length === 1) {
            // detect single touch
            _clientY = event.targetTouches[0].clientY;
        }
    }, false);

    _overlay.addEventListener('touchmove', function (event) {
        if (event.targetTouches.length === 1) {
            // detect single touch
            disableRubberBand(event);
        }
    }, false);

    function disableRubberBand(event) {
        var clientY = event.targetTouches[0].clientY - _clientY;

        if (_overlay.scrollTop === 0 && clientY > 0) {
            // element is at the top of its scroll
            event.preventDefault();
        }

        if (isOverlayTotallyScrolled() && clientY < 0) {
            //element is at the top of its scroll
            event.preventDefault();
        }
    }

    // Nav Sidebar CLASS DEFINITION
    // ============================

    var NavSidebar = function(element, options) {
        var self            = this;
        this.options        = options;
        this.el             = element;
        this.$el            = $(element);
        this.$overlay       = $('.floating-sidebar__overlay');
        
        this.navID          = options.navId;
        this.animationQueue = [];
            
        this.opened = false;
        this.NavSidebar     = null;
        this.init()
    }

    NavSidebar.DEFAULTS = { }

    NavSidebar.prototype.init = function() {
        var self = this

        $('[data-nav-toggle=' + self.navID + ']')
            .on('click', $.proxy(self.toggleSidebar, self));

        self.$overlay.on('click', function()
            {
                if(self.opened) {
                    self.toggleSidebar();
                }
            });

    }   

    /**
     * Toggle Sidebar
     *
     */
    NavSidebar.prototype.toggleSidebar = function()
    {
        var self = this;

        self.$overlay
            .stop(true, true)
            .fadeToggle();

        self.$el.toggleClass('opened');
        
        if(typeof Intercom != 'undefined') {
            Intercom('update', {
                "hide_default_launcher": self.$el.hasClass('opened')
            });
        }
        
        self.$el
            .find('.floating-sidebar__menu a')
            .removeClass('do-animation');

        if(self.$el.hasClass('opened')) {
            self.opened = true;
            $.each(self.animationQueue, function(timeout)
            {
                clearTimeout(timeout);
            });
            $('body').addClass('floating-sidebar--opened');

            var delay = 0;
            self.$el
                .find('.floating-sidebar__menu .nav > li > a').each(function()
                {
                    var $link = $(this);
                    self.animationQueue.push(setTimeout(function()
                    {
                        $link.addClass('do-animation');
                    }, delay));

                    delay += 200;
                });


            self.$el
                .find('.floating-sidebar__menu .nav .dropdown-menu li > a').addClass('do-animation');
                
        } else {
            self.opened = false;

            setTimeout(function()
            {
                $('body').removeClass('floating-sidebar--opened');
            }, 200);
        }
    }

    // NavSidebar PLUGIN DEFINITION
    // ============================

    $.fn.navSidebar = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('trueper.nav-sidebar')
            var options = $.extend({}, NavSidebar.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('trueper.nav-sidebar', (data = new NavSidebar(this, options)))
            else if (typeof option == 'string') data[option].apply(data, args)
        })
    }

    $.fn.navSidebar.Constructor = NavSidebar

    // DeleteActivity DATA-API
    // ===============

    $(document).on('ready', function () {

        $('[data-nav-sidebar]').navSidebar();
    });

}(window.jQuery);
