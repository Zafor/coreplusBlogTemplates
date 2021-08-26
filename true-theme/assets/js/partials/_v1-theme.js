/* -------------------------------------------------- */
/* Resize Boxes
/* -------------------------------------------------- */
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

;(function ($, App) {

    'use strict';

    /**
     * This partial javascript compiles into minified script file
     * and is a great place to register all globally running script.
     *
     * init() method block gets called automatically on *every* page,
     * use this as a starting point to invoke methods
     */

    var v1ThemeBase = function () {}

    v1ThemeBase.prototype.init = function() {
        var self = this;

        var maxBoxHeight = 0;
        var $headerNav = $('#header-nav .nav-menu');
        var $window = $(window);

        var isMobileMode = false;
        if($window.width() < 960)
        {
            isMobileMode = true;
        }

        $('.enquiry-form-wrapper select').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });

        /* Features
        /* -------------------------------------------------- */
        if(TrueLib.isPage('features') || TrueLib.isPage('profession') )
        {
            $(".accordionTab").each(function() {
                $(this).easyResponsiveTabs({
                    type: 'vertical', //Types: default, vertical, accordion
                    width: 'auto', //auto or any custom width
                    fit: true   // 100% fits in a container,
                });
            });
        }

        /* Customers
        /* -------------------------------------------------- */
        if(TrueLib.isPage('customers')) {
            var slider;
            var initDesktop = function()
            {
               slider = $('.customer-slider').bxSlider({
                    mode: 'fade',
                    controls:false,
                    auto: true,
                    slideWidth: 1199,
                    adaptiveHeight: false,
                    infiniteLoop: true,
                    pager: true,
                    moveSlides: 1,
                    minSlides: 1,
                    maxSlides: 1,
                    speed: 500,
                    pause: 13000
                });
            };

            var initMobile = function()
            {
               slider = $('.customer-slider').bxSlider({
                    mode: 'fade',
                    controls:false,
                    auto: true,
                    slideWidth: 1199,
                    adaptiveHeight: true,
                    infiniteLoop: true,
                    pager: true,
                    moveSlides: 1,
                    minSlides: 1,
                    maxSlides: 1,
                    speed: 500,
                    pause: 13000
                });
            };

            var initCustomersSlider = function()
            {
                var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                if(slider != null)
                {
                    slider.destroySlider();
                }

                if (width >= 768)
                {
                    initDesktop();
                } else if (width < 768)
                {
                    initMobile();
                }
            }

            initCustomersSlider();

            var rtime = new Date(1, 1, 2000, 12, 0, 0);
            var timeout = false;
            var delta = 200;

            $( window ).resize(function()
            {
                rtime = new Date();
                if (timeout === false) {
                    timeout = true;
                    setTimeout(resizeCustomerEnd, delta);
                }
            });

            var resizeCustomerEnd = function()
            {
                if (new Date() - rtime < delta) {
                    setTimeout(resizeCustomerEnd, delta);
                } else {
                    timeout = false;
                    initCustomersSlider();
                }
            }
        }

        /* Partners
        /* -------------------------------------------------- */
        if(TrueLib.isPage('partners'))
        {
            var slider;
            var initDesktop = function()
            {
               slider = $('.customer-slider').bxSlider({
                    mode: 'fade',
                    controls:false,
                    auto: true,
                    slideWidth: 1199,
                    adaptiveHeight: false,
                    infiniteLoop: true,
                    pager: true,
                    moveSlides: 1,
                    minSlides: 1,
                    maxSlides: 1,
                    speed: 500,
                    pause: 13000
                });
            };

            var initMobile = function()
            {
               slider = $('.customer-slider').bxSlider({
                    mode: 'fade',
                    controls:false,
                    auto: true,
                    slideWidth: 1199,
                    adaptiveHeight: true,
                    infiniteLoop: true,
                    pager: true,
                    moveSlides: 1,
                    minSlides: 1,
                    maxSlides: 1,
                    speed: 500,
                    pause: 13000
                });
            };

            var initSlider = function()
            {
                var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                if(slider != null)
                {
                    slider.destroySlider();
                }

                if (width >= 768)
                {
                    initDesktop();
                } else if (width < 768)
                {
                    initMobile();
                }
            }
            initSlider();

            var rtime = new Date(1, 1, 2000, 12, 0, 0);
            var timeout = false;
            var delta = 200;

            $( window ).resize(function()
            {
                rtime = new Date();
                if (timeout === false) {
                    timeout = true;
                    setTimeout(resizeend, delta);
                }
            });

            var resizeend = function()
            {
                if (new Date() - rtime < delta) {
                    setTimeout(resizeend, delta);
                } else {
                    timeout = false;
                    initSlider();
                }
            }
        }


        if(TrueLib.isPage('trial'))
        {
            // Referral sources
            var sourceHTML = '';
            var JSON = window.referrerJSON;
            $(JSON).each(function(){
                sourceHTML += '<option value="' + $(this)[0].id + '">' + $(this)[0].name + '</option>';
            });

            $('#referrer').append(sourceHTML);
        }

        var $bankForm = $('.partner-form-bank-details-container');
        $('.privacyagree input, .confirmdetails input').change(function()
        {
            if($('.privacyagree input').is(':checked') && $('.confirmdetails input').is(':checked'))
            {
                if(!$bankForm.is(':visible'))
                {
                    $('.partner-form-bank-details-container').stop(true, true).slideDown();
                }
            } else {
                if($bankForm.is(':visible'))
                {
                    $('.partner-form-bank-details-container').stop(true, true).slideUp();
                }
            }
        });

        /* Professions Page Navigation
        /* ------------------------------------- */
        /*$('.professions-nav-container .parent-nav a').click(function()
        {
            var $child = $('.professions-nav-container').find('.child-nav-' + $(this).data('term-id'));

            if(!$child.hasClass('nav-active'))
            {
                $('.profession-nav.parent-nav li.active').removeClass('active');
                $(this).parent().addClass('active');
                $('.professions-nav-container .children-nav .nav-active').removeClass('nav-active');
                $child.addClass('nav-active');
            }
        });*/

        /* Professions Page Tabs
        /* ------------------------------------- */
        if(TrueLib.isPage('profession')) {
            var $features = $('.features');
            $('.features .tabs-wrapper li').click(function() {
                var $targetTab = $features.find('.features-tab-' + $(this).data('feature-id'));

                if(!$targetTab.hasClass('active')) {
                    $features.find('.features-tab.active')
                        .removeClass('active')
                        .stop(true, true)
                        .fadeOut();

                    $targetTab.addClass('active').stop(true, true).fadeIn();
                    $features.find('.tabs-wrapper li.active').removeClass('active');
                    $(this).addClass('active');

                    moveTabIndicator($targetTab.find('.accordionTab'), $targetTab.find('.features-indicator'));
                }
            });
        }

        if(TrueLib.isPage('profession') || TrueLib.isPage('features')) {
            // Features on Scroll
            $(window).on('scroll resize', function() {
                if($('.features-tab.active .accordionTab').data('mode') == 'ADDON') {
                    var $accordion = $('.features-tab.active .accordionTab');
                    $accordion.find('.features-tab__fixed-nav').each(function() {
                        var $list = $(this);

                        // Should we even bother?
                        if($accordion.outerHeight() <= $list.outerHeight() + 50) {
                            return;
                        }

                        var newTop = App.Common.getHeaderOffset();
                        if($(window).scrollTop() + newTop > $accordion.offset().top) {
                            $list.css({
                                    width: $list.parent().outerWidth() - 1, //fixed fix
                                    top: newTop
                                })
                                .removeClass('stuck')
                                .addClass('fixed');
                        } else {
                            $list.removeClass('fixed stuck')
                                .css({
                                    width: $list.parent().outerWidth()
                                });
                        }

                        if($list.offset().top + $list.outerHeight() > $accordion.offset().top + $accordion.height()) {
                            $list.addClass('stuck')
                                .css({
                                    width: $list.parent().outerWidth() - 1, // absolute fix
                                    top: ($accordion.outerHeight() - ($list.outerHeight()))
                                })
                        }
                    });

                    var sectionNo = 0;
                    $accordion.find('.features-tab__section-heading').each(function() {
                        if($(window).scrollTop() + App.Common.getHeaderOffset() + 20 >= $(this).offset().top) {
                            sectionNo++;
                        }
                    });

                    if(sectionNo == 0) {
                        sectionNo = 1;
                    }

                    var currentIndex = $accordion.find('.resp-tabs-list li.resp-tab-active').index();

                    if(currentIndex != sectionNo - 1) {
                        $accordion.find('.resp-tabs-list li').removeClass('resp-tab-active');
                        $accordion.find('.resp-tabs-list li').eq(sectionNo - 1)
                            .addClass('resp-tab-active');
                        moveTabIndicator($accordion, $accordion.find('.features-indicator'));
                    }
                }
            });
        }

        //Sign up Panel
        // Referral sources
        if($('.sign-up-panel').length > 0)
        {
            var sourceHTML = '';
            var JSON = referrerJSON;
            sourceHTML += '<option value=""></option>';
            $(JSON).each(function(){
                sourceHTML += '<option value="' + $(this)[0].id + '">' + $(this)[0].name + '</option>';
            });

            $('#referrer').append(sourceHTML);
        }

        /* Features */
        var $featuresTabs = $('.features .tabs-wrapper');
        var checkFeaturesScrollPos = function()
        {
            if($featuresTabs && !TrueLib.isPage('profession'))
            {
                if($featuresTabs.length > 0 && TrueLib.windowWidth() >= 960 && !TrueBrowserDetect.isMobile)
                {
                    var headerHeight = $('.header-nav').height();

                    if($('body').hasClass('admin-bar') && TrueLib.windowWidth() >= 960)
                    {
                        headerHeight += $('#wpadminbar').height();
                    }

                    if($window.scrollTop() >= $('.features').offset().top - headerHeight)
                    {
                        $featuresTabs.css('top', headerHeight).addClass('fixed');
                    } else {
                        $featuresTabs.removeClass('fixed');
                    }
                } else {
                    $featuresTabs.removeClass('fixed');
                }
            }
        }

        /* About
        /* -------------------------------------------------- */
        if(TrueLib.isPage('about')) {
            //Oh my lordy, its animation time!

            var aboutAnimation = {
                doTransforms: false,
                allowHover: false,
                setup: function()
                {
                    if($('html').hasClass('csstransforms3d'))
                    {
                        this.doTransforms = true;
                    }
                    if(TrueLib.windowWidth() >= 768)
                    {
                        this.animate();
                    } else {
                        $('.about-logo-full').attr('style', 'display: none !important');
                        $('.about-logo-mobile').attr('style', 'display: block !important');
                    }

                    this.setupTriangleHover();
                },
                animate: function()
                {
                    //Animation Timeline
                    this.animateTriangle('pink-tri', 0, 350);
                    this.animateLine('purple-line', 600, 1000);

                    this.animateTriangle('yellow-tri', 600, 350);
                    this.animateLine('yellow-line', 950, 1000);

                    this.animateTriangle('light-yellow-tri', 1200, 350);

                    this.animateTriangle('blue-tri', 1800, 350);
                    this.animateLine('blue-line', 2150, 1000);

                    this.animateTriangle('light-blue-tri', 2400, 350);
                    this.animateLine('light-blue-line', 2750, 1000);

                    this.animateTriangle('orange-tri', 3000, 350);
                    this.animateLine('orange-line', 3350, 1000);

                    this.animateTriangle('light-orange-tri', 3600, 350);
                },
                animateTriangle: function(target, delay, length)
                {
                    if(this.doTransforms && target != 'pink-tri')
                    {
                        $('.' + target).addClass('willanimate');
                        setTimeout(function()
                        {
                            var tmpTarget = target;
                            $('.' + tmpTarget).addClass('do-animation');
                            if(tmpTarget == 'light-orange-tri')
                            {
                                setTimeout(function()
                                {
                                    $('.' + tmpTarget).addClass('final-animation');
                                    $('.gray-tri').css({opacity: 0, width:0}).show().delay(350).animate({
                                        opacity: 1,
                                        width: 65
                                    }, 300);
                                    //We're allowed to do hover animations now!
                                    setTimeout(function()
                                    {
                                        aboutAnimation.allowHover = true;
                                    }, 350)
                                }, 350);
                            }
                        }, delay)

                    } else {
                        $('.' + target).delay(delay).fadeIn(length, function()
                            {
                                if(target == 'light-orange-tri')
                                {
                                    aboutAnimation.allowHover = true;
                                }
                            }
                        );
                    }
                },
                animateLine: function(target, delay, length)
                {
                    var $line = $('.' + target);
                    var height = parseInt($line.data('true-height'), 10);
                    var width = parseInt($line.data('true-width'), 10);

                    $line.delay(delay).css({ height: 0, width: 0, 'display': 'block' });

                    var direction = $line.data('true-direction');

                    var firstAnimation = 'height';
                    var firstValue = height;

                    var secondAnimation = 'width';
                    var secondValue = width;

                    var startHeight = 2;
                    var startWidth = 2;
                    if(target == 'orange-line')
                    {
                        startWidth = 0;
                    }

                    $line.css('width', startWidth).animate(
                        {
                            'height': height
                        },
                    length, 'linear', function()
                    {
                        $line.animate(
                        {
                            'width': width
                        },
                        length, 'linear', function()
                        {
                            $line.css('overflow', 'visible').find('span').fadeIn();
                        });
                    });
                },
                setupTriangleHover: function()
                {
                    var self = this;
                    $('.triangle-container span').hover(function()
                    {
                        if($(this).data('target') != null && self.allowHover)
                        {
                            $('.logo-triangle').stop(true).animate(
                                {
                                    opacity: 0.3
                                }
                            );

                            var target = $('.' + $(this).data('target'));
                            target.clearQueue().finish().css('opacity', 1);
                        }
                    }, function()
                    {
                        if($(this).data('target') != null && self.allowHover)
                        {
                            $('.logo-triangle').stop(true).animate(
                                {
                                    opacity: 1
                                }
                            );
                        }
                    });
                }
            }

            aboutAnimation.setup();
        }

        /* Contact */
        $('#wpcf7-f890-o1').on('invalid.wpcf7 mailsent.wpcf7', function()
        {
            TrueLib.scrollTo($(this).offset().top -30);
        });

        if(TrueLib.isPage('pricing'))
        {
            var pricingAnimation = {
                $orangeBar: $('.pricing-bar.orange'),
                isMobile: false,
                currentStep: 1,
                xhrObject: null,
                init: function()
                {
                    //Setup our checks to decide on our animation speeds
                    if(TrueLib.windowWidth() < 768)
                    {
                        this.isMobile = true;
                    }
                    $(window).resize(function()
                    {
                        if(TrueLib.windowWidth() < 768)
                        {
                            this.isMobile = true;
                        }
                    });

                    this.animateBarToStep(1);
                },

                animateBarToStep: function(step)
                {
                    var barAnimationSpeed = 500;
                    var stepNoAnimationSpeed = 300;

                    if(this.isMobile)
                    {
                        barAnimationSpeed = 350;
                        stepNoAnimationSpeed = 150;
                    }

                    var stepNo = this.currentStep;
                    step = step -1;
                    this.$orangeBar.animate(
                        {
                            width: (step * 26.67) + '%'
                        }, barAnimationSpeed, 'linear');

                    if(this.currentStep != 4)
                    {
                        $('.pricing-column.column-' + stepNo).find('.pricing-step-active').delay(barAnimationSpeed).animate(
                            {
                                width: 56
                            }, stepNoAnimationSpeed, 'linear'
                        , function()
                        {
                            $('.pricing-column.column-' + stepNo).find('.chosen-select').attr('disabled', false).trigger("chosen:updated");
                        });
                    } else {
                        //Calculate the total, and display!
                        this.calculatePricing();
                    }
                },

                next: function()
                {
                    if(this.currentStep < 4)
                    {
                        this.currentStep++;
                        this.animateBarToStep(this.currentStep);
                    } else {
                        //Just calculate the pricing?
                        this.calculatePricing();
                    }
                },

                validateStepChange: function($dropdown)
                {
                    if($dropdown.val() != -1)
                    {
                        //Get the step number just incase we're already passed this step
                        var dropdownStep = $dropdown.parents('.pricing-column').data('step-no');

                        if(dropdownStep >= this.currentStep || this.currentStep == 4)
                        {
                            var partTime = $('.pricing-column.column-1 select').val();
                            var fullTime = $('.pricing-column.column-2 select').val();

                            if(this.currentStep == 2 && (partTime != -1 || fullTime != -1))
                            {
                                this.next();
                            } else if(this.currentStep != 2) {
                                this.next();
                            }
                        }
                    }
                },

                calculatePricing: function()
                {
                    if(this.currentStep == 4)
                    {
                        var $currCol = $('.pricing-column.column-' + this.currentStep);
                        $currCol.find('.pricing-step-active').css('width', 0);

                        $('.pricing-total').stop(true, true).fadeOut();
                        $('.pricing-plan-features.active').stop(true, true).removeClass('active').slideUp();
                        $('.pricing-box-item.active.multi').find('.pricing-plan-price div').html('-');
                        $('.pricing-box-item.active').removeClass('active').css('display', '');

                        //Check if we need to contact them
                        if($('.pricing-column.column-1 select').val() == 'contact' || $('.pricing-column.column-2 select').val() == 'contact')
                        {
                            if(!$('.pricing-box-item.plan-box-id-contact').hasClass('active'))
                            {
                                $currCol.find('.pricing-step-active').delay(350).animate(
                                            {
                                                width: 56
                                            }, 300, 'linear');

                                $('.pricing-box-item.multi').stop(true, true).removeClass('active').fadeOut(350, function()
                                {
                                    $('.pricing-box-item.plan-box-id-contact').addClass('active').stop(true, true).delay(100).fadeIn().css('display', 'inline-block');
                                });
                            }
                        } else {
                            //do we need to show the multi box?
                            $('.pricing-box-item.plan-box-id-contact').stop(true, true).removeClass('active').fadeOut(350, function()
                            {
                                if(!$('.pricing-box-item.multi').is(':visible'))
                                {
                                    if(TrueLib.windowWidth() > 768)
                                    {
                                        $('.pricing-box-item.multi').stop(true, true).fadeIn();
                                    }
                                }
                            });

                            if($('.pricing-column.column-1 select').val() >= 0 && $('.pricing-column.column-2 select').val() >= 0 && $('#subscriptionSelect').val() > 0)
                            {
                                if(this.xhrObject != null)
                                {
                                    this.xhrObject.abort();
                                }
                                $currCol.find('.pricing-step-loader').stop(true, true).fadeIn();

                                //Assemble our data
                                var data = {
                                    action: 'calculate_pricing',
                                    parttime: $('#partTimeSelect').val(),
                                    fulltime: $('#fullTimeSelect').val(),
                                    subscription: $('#subscriptionSelect').val()
                                };
                                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                                this.xhrObject = $.post(ajax_object.ajax_url, data, function(response)
                                {
                                    $currCol.find('.pricing-step-loader').stop(true, true).fadeOut();
                                    $('.pricing-box-item.active').removeClass('active').css('display', '');

                                    if(response['status'] == 'success')
                                    {
                                        $('.plan-id-' + response['plan-id']).stop(true, true).addClass('active').delay(1000).slideDown();

                                        //Do the animation and then show the price!
                                        $currCol.find('.pricing-step-active').delay(500).animate(
                                            {
                                                width: 56
                                            }, 300, 'linear'
                                        , function()
                                        {
                                            $('.pricing-total').fadeIn().html(response['price']);
                                            $('.plan-box-id-' + response['plan-id']).stop(true, true).fadeIn(350, function()
                                            {
                                                $(this).css('display', 'inline-block');
                                            }).addClass('active');


                                            $('.plan-box-id-' + response['plan-id']).find('.pricing-plan-price div').html(response['price']);

                                        });
                                    } else {
                                        //Something went wrong, hide everything
                                        $('.pricing-total').html('').hide();
                                    }
                                }, 'json');
                            } else {
                                $('.pricing-total').html('').hide();
                            }
                        }
                    }
                }

            }

            pricingAnimation.init();
            $('#pricingtest').click(function()
            {
                pricingAnimation.next();
            });

            $('#pricingcalc').click(function()
            {
                pricingAnimation.currentStep = 4;
                pricingAnimation.calculatePricing();
            });

            /* Pricing Page Tool tips
            /* -------------------------------------------------- */
            $('.pricing-column-title.hastooltip span.abbr').each(function()
            {
                $(this).qtip({
                    content: {
                        text: $(this).parent().next('div')
                    },
                    style: { classes: 'qtip-dark' },
                    position: {
                        my: 'top center',
                        at: 'bottom center'

                    }
                });
            });

            var toggleExpand = function(selector, contentToExpand) {
                $(selector).click(function() {
                    $(this).toggleClass('expanded');
                    $(this).next(contentToExpand).slideToggle(300);
                });
            }

            $('.price-table .parent').click(function() {
                $(this).toggleClass('expanded');
                $(this).next('.subfield').find('.subfield-wrapper').slideToggle(300);
            });

            //toggleExpand('.price-view-more, .price-view-more-mobile', '.price-view-more-content');

            /* View More Desktop */
            $('.pricing-table-desktop .price-view-more').click(function() {
                $(this).toggleClass('expanded');
                $(this).prev('.price-view-more-content').slideToggle(300);

                //$('.price-table-main').toggleClass('expanded');

                if($(this).hasClass('expanded')) {
                    if($(this).data('hide-text').length > 0) {
                        $(this).find('span').html($(this).data('hide-text'));
                    }

                    $(this).prev('.price-view-more-content').css({'position':'relative', 'top': '-1px'});

                    //$(this).prev('.price-view-more-content').find('> .price-table > tbody > tr:first-child td').css('border-top-width', '0px');
                }
                else {
                    $(this).find('span').html($(this).data('expand-text'));
                }

            });

            /* View More Mobile */
            $('.price-view-more-mobile').click(function() {
                $(this).toggleClass('expanded');
                $(this).next('.price-view-more-content').slideToggle(300);

                if($(this).hasClass('expanded')) {
                    if($(this).data('hide-text').length > 0) {
                        $(this).find('span').html($(this).data('hide-text'));
                    }
                }
                else {
                    $(this).find('span').html($(this).data('expand-text'));
                }

            });


            $('.plan-details-list .parent > .details-left').click(function() {
                $(this).toggleClass('expanded');
                $(this).parent().find('.subfield-wrapper').slideToggle(300);
            });

            toggleExpand('.plan-mobile .plan-heading', '.plan-details');

            $('.plan-feature-tooltip').each(function() {
                $(this).qtip({
                    content: {
                        text: $(this).next('div.hidden-tip')
                    },
                    style: { classes: 'qtip-dark' },
                    position: {
                        my: 'top center',
                        at: 'bottom center'
                    }
                })
            });

            $('.mobile-plan-feature-tooltip').magnificPopup();

            // FAQ Expand/Collapse
            toggleExpand('.pricing-faq .price-view-more', '.pricing-faq-container');
            toggleExpand('.pricing-simplified.section-title', '.faq-description');

            // To display additional details expanded on load, add #viewall to the URL
            if($(location).attr('hash') === '#viewall') {
                $('.price-view-more, .price-view-more-mobile').addClass('expanded');
                $('.price-view-more, .price-view-more-mobile').each(function() {
                    $(this).next('.price-view-more-content').slideDown(300);
                });
            }
        }
    }


    window.App.v1ThemeBase = new v1ThemeBase();

})(jQuery, window.App);
