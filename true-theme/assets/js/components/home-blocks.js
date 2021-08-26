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

    // HomeBlocks CLASS DEFINITION
    // ============================

    var HomeBlocks = function(element, options) {
        var self         = this;
        this.options     = options;
        this.el          = element;
        this.$el         = $(element);

        this.$window     = $(window);
        this.$header     = $('.header');
        this.$headerContainer = $('.header-container');

        this.headerAnimating = null;
        this.headerAnimationTimer = null;

        this.init();
    }

    HomeBlocks.DEFAULTS = { }

    /**
     * On Init
     *
     */
    HomeBlocks.prototype.init = function() {
        var self = this;

        self.setupBanners();
        self.setupOverviewBlock();
        self.setupFeatureBlock();
    }

    /**
     * Setup Banners
     *
     */
    HomeBlocks.prototype.setupBanners = function() {
        var self = this;

        var delay = 100;
        self.$el.find('.banner__col').each(function() {
            var $col = $(this);
            setTimeout(function() {
                $col.addClass('do-animation');
            }, delay);

            delay += 500;
        });
    }

    /**
     * Setup Overview Blocks
     *
     */
    HomeBlocks.prototype.setupOverviewBlock = function()
    {
        var self = this;
        self.$overviewBlock = this.$el.find('.overview-block');
        self.$overviewBlockNav = this.$el.find('.overview-block__nav');
    }

    HomeBlocks.prototype.doShadowIconAnimation = function($source)
    {
        var self = this;

        var delay = 100;

        $source.find('.shadow-icon').each(function()
        {
            var $icon = $(this);

            setTimeout(function()
            {
                $icon.addClass('do-animation');
            }, delay);

            delay += 150;
        });
    }

    HomeBlocks.prototype.setupFeatureBlock = function()
    {
        var self = this;
        self.$featureBlock = this.$el.find('.feature-block');

        self.doneFeatureAnimation = false;

        calculateBoxHeights(self.$featureBlock.find('.feature-block-item__content'));

        $(window).on('resize', function()
        {
            calculateBoxHeights(self.$featureBlock.find('.feature-block-item__content'));
        });

        if(self.onScreen() >= self.$featureBlock.offset().top) {
            //self.doShadowIconAnimation(self.$featureBlock);
        }

    }


    HomeBlocks.prototype.mostlyOnScreen = function()
    {
        return self.$window.scrollTop() + (self.$window.height() * 0.25);
    }

    HomeBlocks.prototype.onScreen = function()
    {
        return self.$window.scrollTop() + (self.$window.height() - 200);
    }


    HomeBlocks.prototype.getScrollToPos = function(pos)
    {
        if($('body').hasClass('admin-bar') && $(window).width() >= 768) {
            pos -= 31;
        }

        return pos;
    }


    // HomeBlocks PLUGIN DEFINITION
    // ============================

    $.fn.homeBlocks = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('trueper.home-blocks')
            var options = $.extend({}, HomeBlocks.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('trueper.home-blocks', (data = new HomeBlocks(this, options)))
            else if (typeof option == 'string') data[option].apply(data, args)
        })
    }

    $.fn.homeBlocks.Constructor = HomeBlocks

    // HomeBlocks DATA-API
    // ===============

    $(document).on('ready', function () {
        $('[data-control="home-blocks"]').homeBlocks();
    });

}(window.jQuery);
