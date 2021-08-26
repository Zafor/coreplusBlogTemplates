;(function ($, App) {

    'use strict';

    /**
     * This partial javascript compiles into minified script file
     * and is a great place to register all globally running script.
     *
     * init() method block gets called automatically on *every* page,
     * use this as a starting point to invoke methods
     */

    var Common = function () {}

    Common.prototype.init = function() {
        var self = this;
        $(".trial-signup-block__form .wpcf7-form .row input.wpcf7-form-control").unwrap();
        $('.parallax').parallax();

        self.setupFooter();
        self.setupVideoPlayer();

        if(!$('body').hasClass('home')) {
            App.v1ThemeBase.init();
        }

        var speed = 1;

        //if(!TrueBrowserDetect.isMobile) {
            $(window).scroll(function() {
                var windowYOffset = window.pageYOffset,
                elBackgrounPos = "50% " + (windowYOffset * speed) + "px";
                $('.banner--fixed').css('background-position', 'left ' + ((elBackgrounPos)) + 'px');
            });
        //}

        self.initStickyFilter();
        $(window).on('resize', function(){
            self.initStickyFilter();
        });

        self.initFilterLink();
    }

    /**
     * Video Player
     *
     */
    Common.prototype.setupVideoPlayer = function()
    {
        var self = this;

        var leftButton = '<a class="btn btn--colour-orange btn--size-fixed-width btn--no-shadow" href="/trial/">Start a Free Trial</a>';
        var rightButton = '<a class="btn btn--colour-white-black btn--size-fixed-width btn--no-shadow" href="' + corplus_app_url + '" target="_blank">Login</a>';

        $('.popup-youtube').magnificPopup({
            disableOn: 0,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,            
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                '<div class="mfp-close"></div>'+
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
              '</div><div class="banner-video-popup__buttons">' + leftButton + rightButton + '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button    
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: '//www.youtube.com/embed/%id%/?autoplay=1&showinfo=0&controls=2&modestbranding=1&rel=0&theme=dark'
                    }
                }
            }
        });      

        // Record banner video clicks
        $('.popup-youtube').click(function() {
            if(self.readCookie('banner_video_view') === null) {
                self.createCookie('banner_video_view', '1', 1000);
            }
        });

        // Media banner video
        $('.video-link').magnificPopup({
            disableOn: 0,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,            
            iframe: {
                markup: '<div class="mfp-iframe-scaler">'+
                '<div class="mfp-close"></div>'+
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
              '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button    
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: '//www.youtube.com/embed/%id%/?autoplay=1&showinfo=0&controls=2&modestbranding=1&rel=0&theme=dark'
                    }
                }
            }
        });
    }

    Common.prototype.createCookie = function(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }
    
    Common.prototype.readCookie = function(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    /**
     * Setup the Footer
     *
     */
    Common.prototype.setupFooter = function()
    {
        $('.site-footer__slider').show().slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }]
        });
    }
    
    Common.prototype.getHeaderOffset = function() {
        return $('.header').outerHeight() + $('#wpadminbar').outerHeight();
    }

    Common.prototype.initStickyFilter = function() {
        var self = this;
        self.initMobileStickyFilter();

        $(window).scroll(function () {
            var windowWidth = $(window).width();
            if (windowWidth < 1127) {
                return;
            }
            var $navBar = $('.header-container');
            var $addBanner = $('[data-addon-banner]');
            var $stickyContainer = $('[data-sticky-container]');
            var $stickyFilter = $('[data-sticky]');

            var navHeight = $navBar.outerHeight();
            var bannerHeight = $addBanner.outerHeight();
            var containerHeight = $stickyContainer.outerHeight();
            var containerOffTopSpace = navHeight + bannerHeight + containerHeight - 300;

            var scrollTop = window.pageYOffset;

            if(scrollTop > 220 && scrollTop <= containerOffTopSpace){
                $stickyFilter.css({
                    'top': '30px',
                    'position': 'fixed'
                })
            } else if (scrollTop > containerOffTopSpace) {
                $stickyFilter.css({
                    'top': 'auto',
                    'bottom': '50px',
                    'position': 'absolute'
                })
            } else {
                $stickyFilter.css({
                    'top': '0',
                    'position': 'absolute'
                })
            }
        })
    }

    Common.prototype.initMobileStickyFilter = function() {
        var windowWidth = $(window).width();
        if (windowWidth < 1127) {
            $('[data-sticky]').css({
                'top': '0',
                'bottom': 'auto',
                'position': 'relative'
            })
            return;
        } else {
            $('[data-sticky]').css({
                'top': '0',
                'position': 'absolute'
            })
        }
    }

    Common.prototype.initFilterLink = function() {
        $('[data-post-filter-item]').each(function() {
            var $this = $(this);
            var backLinkUrl = $this.data('back-url');
            var termUrl = $this.data('term-url');
            var redirectUrl = termUrl;

            $this.on('click', function() {
                if ($this.hasClass('active')) {
                    redirectUrl = backLinkUrl;
                }
                window.location.href = redirectUrl;
            })
        })
    }

    window.App.Common = new Common();

})(jQuery, window.App);
