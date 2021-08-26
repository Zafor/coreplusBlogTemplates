/*
 * Site Header Plugin
 *
 *
 */

+function ($) { "use strict";

    // HomeBlocks CLASS DEFINITION
    // ============================

    var SiteHeader = function(element, options) {
        var self         = this;
        this.options     = options;
        this.el          = element;
        this.$headerContainer         = $(element);

        this.hasAdminbar = $('body').hasClass('admin-bar');
        this.headerAnimating = null;

        this.$header     = this.$headerContainer.find('.header');

        this.$window     = $(window);

        this.init();
    }

    SiteHeader.DEFAULTS = { }

    /**
     * On Init
     *
     */
    SiteHeader.prototype.init = function() {
        var self = this;

        self.setupDropdownAnimation();
        self.setupLiveChat();
        
        //Don't operate on the homepage
        // if($('body').hasClass('home')) {
        //     setTimeout(function() {
        //         self.checkNavbarPosition();    
        //     }, 50);

        //     self.$window.on('scroll resize', $.proxy(self.checkNavbarPosition, self));
        // } else {
        //     self.$header.addClass('navbar-fixed-top header--collapsed');
        // }
    }

    SiteHeader.prototype.setupLiveChat = function()
    {
        //Toggle olack
        $('body li.open-live-chat').on('click', function(e) {
            e.preventDefault();

            if(typeof Intercom !== 'undefined') {
                Intercom('show')
            }

            return false;
        });
    }

    SiteHeader.prototype.setupDropdownAnimation = function()
    {
        var self = this;

        $('.header-nav .dropdown, .floating-sidebar .dropdown').on('show.bs.dropdown', function() {

            $(this).find('.dropdown-menu')
                .first()
                .stop(true, true)
                .slideDown(600);

            var delay = 50;
            var delayAmount = 600 / $(this).find('.dropdown-menu a').length;

            $(this).find('.dropdown-menu a').each(function() {
                var $span = $(this);

                setTimeout(function() {
                    $span.addClass('do-animation');
                }, delay);

                delay += 100;
            });
        });

        // Add slideUp animation to Bootstrap dropdown when collapsing.
        $('.header-nav .dropdown, .floating-sidebar .dropdown').on('hide.bs.dropdown', function() {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(function() {
                $(this).find('a').each(function() {
                    $(this).removeClass('do-animation');
                });
            });
        });

        //Search toggle
        $('.header-nav__search-icon, .header-search__close-search').click($.proxy(self.toggleSearch, self));
    }

    /**
     * Toggle the Search Form
     *
     */
    SiteHeader.prototype.toggleSearch = function()
    {
        $('.header').toggleClass('header--search-opened');

        if(!$('.header-search').hasClass('opened')) {
            $('.header-search').toggle();

            setTimeout(function()
            {
                $('.header-search').toggleClass('opened');

                if($('.header-search').hasClass('opened')) {
                    $('.header-search input').focus();
                }
            }, 100);
        } else {
            $('.header-search').toggleClass('opened');

            setTimeout(function() {
                $('.header-search').toggle();
            }, 350);
        }
    }

    SiteHeader.prototype.checkNavbarPosition = function()
    {
        var self = this;
        var distance = -130;
        var animateTo = 0;
        if(self.hasAdminbar) {
            if(self.$window.width() >= 975) {
                animateTo = 31;
            }
        }
        
        var scrollPoint = 0;
        if($('body').hasClass('home')) {
            scrollPoint += $('.overview-block__nav').offset().top + $('.overview-block__nav').outerHeight();
        }
        
        if(self.$window.scrollTop() + animateTo > scrollPoint) {
            if(self.headerAnimating != 'DOWN') {
                if(self.$header.hasClass('navbar-fixed-top')) {
                    return;
                }
                self.headerAnimating = 'DOWN';

                self.$header
                    .css('top', distance)
                    .addClass('navbar-fixed-top header--collapsed')
                    .stop(true, true).animate({
                        top: animateTo
                    });
                
            }
        } else {

            if(self.headerAnimating == 'DOWN') {
                self.headerAnimating = 'UP';
               
                self.$header.stop(true, true).animate({
                    top: distance
                }, function()
                {
                    self.$header
                        .removeClass('navbar-fixed-top header--collapsed')
                        .css('top', 0);
                });
            } else {
                if(self.$window.scrollTop() < self.$headerContainer.offset().top + 200) {
                    self.$header.stop(true, true)
                        .removeClass('navbar-fixed-top header--collapsed')
                        .css('top', 0);
                }
            }
        }

        // if(self.$window.scrollTop() + self.$header.outerHeight() + animateTo > scrollPoint) {
        //     self.$header.css('top', animateTo)
        //         .addClass('navbar-fixed-top header--collapsed');

        // } else {
        //     self.$header.stop(true, true)
        //         .removeClass('navbar-fixed-top header--collapsed')
        //         .css('top', distance);
        // }
    }


    // SiteHeader PLUGIN DEFINITION
    // ============================

    $.fn.siteHeader = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('trueper.site-header')
            var options = $.extend({}, SiteHeader.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('trueper.site-header', (data = new SiteHeader(this, options)))
            else if (typeof option == 'string') data[option].apply(data, args)
        })
    }

    $.fn.siteHeader.Constructor = SiteHeader

    // HomeBlocks DATA-API
    // ===============

    $(document).on('ready', function () {
        $('[data-control="site-header"]').siteHeader();
    });

}(window.jQuery);
