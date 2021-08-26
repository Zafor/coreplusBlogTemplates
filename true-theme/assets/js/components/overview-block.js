/*
 * Home Blocks Form Plugin
 *
 *
 */

+function ($) { "use strict";

    function calculateBoxHeights($boxesToFix)
    {
        if($window.width() > 767)
        {
            $boxesToFix.css({ height: 'auto' });
            var maxHeight = Math.max.apply(null, $boxesToFix.map(function ()
            {
                return $(this).height();
            }).get());
            // set all divs to the same height

            $boxesToFix.css({ height: maxHeight + 'px' });
        } else {
            $boxesToFix.css({ height: 'auto' });
        }
    }

    // OverviewBlocks CLASS DEFINITION
    // ============================

    var OverviewBlocks = function(element, options) {
        var self         = this;
        this.options     = options;
        this.el          = element;
        this.$el         = $(element);

        this.$window     = $(window);

        self.$overviewBlocksNav = this.$el.find('.overview-block__nav');

        this.init();
    }

    OverviewBlocks.DEFAULTS = { }

    /**
     * On Init
     *
     */
    OverviewBlocks.prototype.init = function() {
        var self = this;

        self.setupOverviewBlocks();

        $(window).on('scroll resize', $.proxy(self.checkScrollPosition, self));
    }

    /**
     * Setup Overview Blocks
     *
     */
    OverviewBlocks.prototype.setupOverviewBlocks = function()
    {
        var self = this;

        self.doneOverviewAnimation = false;

        if(self.onScreen() >= self.$el.offset().top) {
            self.showBannerAnimation();
        }    

        self.$el.find('.overview-block__nav li > a').click(function() {
            if(self.$window.scrollTop() != self.$el.offset().top) {
                $("html, body").animate({ scrollTop: self.getScrollToPos(self.$el.offset().top) });
            }   

            self.switchTab($(this));
        });

        self.$el.find('.overview-block__mobile-nav-header').on('click', function()
        {
            $(this).toggleClass('opened');

            self.$el.find('.overview-block__nav .nav')
                .stop(true, true)
                .slideToggle();
        });  

        self.$el.find('.overview-block__nav a').click(function()
        {
            if($('body').width() < 768) {
                self.$el.find('.overview-block__mobile-nav-header').trigger('click');
            }

        });
    }

    /**
     * Switch the current Tab
     *
     * @param  jQueryEl $source
     *
     */
    OverviewBlocks.prototype.switchTab = function($source)
    {
        var self = this;

        if($source.parent().hasClass('active')) {
            return;
        }

        self.$overviewBlocksNav.find('li.active')
            .removeClass('active');

        $source.parent().addClass('active');

        var $newTab = $('#' + $source.data('target'));

        var $oldTab = self.$el.find('.overview-block__tab.active');
            
        self.$el.find('.overview-block__tabs').css('minHeight', $oldTab.outerHeight());

        $oldTab.removeClass('active')
            .addClass('fade-out')
            .animate({
                opacity: 0
            }, 300, function()
            {
                $oldTab.hide()
                    .css('opacity', 1)
                    .removeClass('fade-out');

                self.$el.find('.overview-block__tabs').css('minHeight', 0);
            });

        $newTab.show().addClass('active');

        // Remove the existing colour
        self.$overviewBlocksNav.find('li').each(function()
        {
            var colourClass = $(this).data('colour');
            if(typeof colourClass === 'undefined') {
                return;
            }
    
            self.$el.removeClass('overview-block--colour-' + colourClass.toLowerCase());
        });

        var colourClass = $source.parent().data('colour');

        self.$el.addClass('overview-block--colour-' + colourClass.toLowerCase());
        
        self.showBannerAnimation();
    }

    OverviewBlocks.prototype.showBannerAnimation = function()
    {
        var self = this;
        var $banner = self.$el.find('.overview-block__tab.active .banner__content');
        $banner.css('backgroundImage', 'url(' + $banner.data('bg') + ')');
    }

    /**
     * Check if we need to do any animations
     *
     * @return {[type]} [description]
     */
    OverviewBlocks.prototype.checkScrollPosition = function()
    {
        var self = this;

        if(!self.doneOverviewAnimation && self.onScreen() >= self.$el.offset().top) {
            self.doneOverviewAnimation = true;
            self.showBannerAnimation();
        }
    }

    OverviewBlocks.prototype.mostlyOnScreen = function()
    {
        return self.$window.scrollTop() + (self.$window.height() * 0.25);
    }

    OverviewBlocks.prototype.onScreen = function()
    {
        return self.$window.scrollTop() + (self.$window.height() - 200);
    }


    OverviewBlocks.prototype.getScrollToPos = function(pos)
    {
        if($('body').hasClass('admin-bar') && $(window).width() >= 768) {
            pos -= 32;
        }
        
        pos -= $('.header').outerHeight();
        
        return pos;
    }


    // OverviewBlocks PLUGIN DEFINITION
    // ============================

    $.fn.overviewBlocks = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('trueper.overview-block')
            var options = $.extend({}, OverviewBlocks.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('trueper.hoverview-block', (data = new OverviewBlocks(this, options)))
            else if (typeof option == 'string') data[option].apply(data, args)
        })
    }

    $.fn.overviewBlocks.Constructor = OverviewBlocks

    // OverviewBlocks DATA-API
    // ===============

    $(document).on('ready', function () {
        $('[data-control="overview-blocks"]').overviewBlocks();
    });

}(window.jQuery);
