// Easy Responsive Tabs Plugin
// Author: Samson.Onna <Email : samson3d@gmail.com>

function moveTabIndicator($respTabs, $marker) {
    var $currentTab = $respTabs.find('.resp-tab-active');
    // if(!$indicator.is(":visible")) { 
    //     return;
    // }
    if($currentTab.length > 0) {
        var newPos = $currentTab.position().top + ($currentTab.outerHeight() / 2) - 13;
        
        if($marker.is(":visible")) {        	                
            $marker.stop(true, true).animate({
                top: newPos
            });
        } else {
            $marker.css({
                    opacity: 1, 
                    top: newPos 
                })
                .stop(true, true)
                .fadeIn(600);
        }
    }
}

(function ($) {
    $.fn.extend({
        easyResponsiveTabs: function (options) {
            //Set the default values, use comma to separate the settings, example:
            var defaults = {
                type: 'default', //default, vertical, accordion;
                width: 'auto',
                fit: true
            }
            //Variables
            var options = $.extend(defaults, options);            
            var opt = options, jtype = opt.type, jfit = opt.fit, jwidth = opt.width, vtabs = 'vertical', accord = 'accordion';

            //Main function
            this.each(function () {
                var $respTabs = $(this);

                $respTabs.find('ul.resp-tabs-list li').addClass('resp-tab-item');
                $respTabs.css({
                    'display': 'block',
                    'width': jwidth
                });

                $respTabs.find('.resp-tabs-container > div').addClass('resp-tab-content');
                jtab_options();
                //Properties Function
                function jtab_options() {
                    if (jtype == vtabs) {
                        $respTabs.addClass('resp-vtabs');
                    }
                    if (jfit == true) {
                        $respTabs.css({ width: '100%', margin: '0px' });
                    }
                    if (jtype == accord) {
                        $respTabs.addClass('resp-easy-accordion');
                        $respTabs.find('.resp-tabs-list').css('display', 'none');
                    }
                }

                //Assigning the h2 markup to accordion title
                var $tabItemh2;
                $respTabs.find('.resp-tab-content')
                    .before("<h2 class='resp-accordion' role='tab'><span class='resp-arrow'></span></h2>");

                var itemCount = 0;
                $respTabs.find('.resp-accordion').each(function () {
                    $tabItemh2 = $(this);
                    var innertext = $respTabs.find('.resp-tab-item:eq(' + itemCount + ')').html();
                    //If its a heading, remove its arrow
                    if($respTabs.find('.resp-tab-item:eq(' + itemCount + ')').hasClass('heading')) {
                    	$tabItemh2.children('span').remove();
                    	$tabItemh2.addClass('heading');
                    } else {
                    	$tabItemh2.addClass('item');
                    }
                    $respTabs.find('.resp-accordion:eq(' + itemCount + ')').append(innertext);
                    $tabItemh2.attr('aria-controls', 'tab_item-' + (itemCount));
                    itemCount++;
                });

                //Assigning the 'aria-controls' to Tab items
                var count = 0,
                    $tabContent;
                $respTabs.find('.resp-tab-item').each(function () {
                	
                    $tabItem = $(this);
                    
                    $tabItem.attr('aria-controls', 'tab_item-' + (count));
                    $tabItem.attr('role', 'tab');

                    //Assigning the 'aria-labelledby' attr to tab-content
                    var tabcount = 0;
                    $respTabs.find('.resp-tab-content').each(function () {
                        $tabContent = $(this);
                        $tabContent.attr('aria-labelledby', 'tab_item-' + (tabcount));
                        tabcount++;
                    });
                    count++;
                });
                
                //First active tab
                if($respTabs.find('.resp-tab-active').length == 0) {
	                $respTabs.find('.resp-tab-item.item').first().addClass('resp-tab-active');
	                $respTabs.find('.resp-accordion.item').first().addClass('resp-tab-active');
	                $respTabs.find('.resp-tab-content.item-content').first().addClass('resp-tab-content-active').attr('style', 'display:block');
	            }
	            var $indicator = $respTabs.find('.features-indicator');
                
	            $(window).resize(function() {
	                moveTabIndicator($respTabs, $indicator);
	            });
                moveTabIndicator($respTabs, $indicator);
                
                var mode = $respTabs.data('mode');
                
                //Tab Click action function
                $respTabs.find("[role=tab]").each(function () {
                    var $currentTab = $(this);
                    
                    if($currentTab.hasClass('disable-tab')) return;
                    
                    $currentTab.click(function () {
                        var $tabAria = $currentTab.attr('aria-controls');
                        
                        // Layout type
                        if(mode == 'ADDON') {
                            
                            var pos = $respTabs.find('.resp-tab-content[aria-labelledby = ' + $tabAria + ']')
                                .stop(true, true)
                                .offset()
                                .top;
                                
                            pos = pos - $('.header').height();

                            if($('body').hasClass('admin-bar')) {
                                pos = pos - $('#wpadminbar').height();
                            }
                                
                            $('html, body').stop(true, true)
                                .animate({
                                    scrollTop: pos
                                }, 1000);
                        } else {
                            if($currentTab.hasClass('heading')) return;

                            if ($currentTab.hasClass('resp-accordion') && $currentTab.hasClass('resp-tab-active')) {
                                $respTabs.find('.resp-tab-content-active')
                                    .slideUp('', function () { 
                                        $(this).addClass('resp-accordion-closed'); 
                                    });
                                $currentTab.removeClass('resp-tab-active');
                                return false;
                            }
                            if (!$currentTab.hasClass('resp-tab-active') && $currentTab.hasClass('resp-accordion')) { //Accordion
                                $respTabs.find('.resp-tab-active').removeClass('resp-tab-active');
                                $respTabs.find('.resp-tab-content-active').slideUp().removeClass('resp-tab-content-active resp-accordion-closed');
                                $respTabs.find("[aria-controls=" + $tabAria + "]").addClass('resp-tab-active');
                                
                                $respTabs.find('.resp-tab-content[aria-labelledby = ' + $tabAria + ']').slideDown().addClass('resp-tab-content-active');
                                                            
                            } else {
                                //check its not the same Tab
                                if($respTabs.find('.resp-tab-active').attr('aria-controls') == $tabAria) return;
                                $respTabs.find('.resp-tab-active').removeClass('resp-tab-active');

                                if($(window).width() >= 768) {
                                    var pos = jQuery('#primary').offset().top;

                                    if($('body').hasClass('profession')) {
                                        pos = $currentTab.closest('.features-tab')
                                            .offset().top;
                                    }
                                } else {
                                
                                    var pos = jQuery(this).offset().top;
                                }
                                
                                pos = pos - $('.header').height();

                                if($('body').hasClass('admin-bar')) {
                                    pos = pos - $('#wpadminbar').height();
                                }

                                $('html, body').stop(true, true)
                                    .animate({
                                        scrollTop: pos - 70
                                    }, 1000);
                                
                                $respTabs.find('.resp-tab-content-active')
                                    .stop(true, true)
                                    .fadeOut(400, function()  {
                                        $respTabs.find('.resp-tab-content-active')
                                            .removeAttr('style')
                                            .removeClass('resp-tab-content-active')
                                            .removeClass('resp-accordion-closed');
                                            
                                        $respTabs.find('.resp-tab-content[aria-labelledby = ' + $tabAria + ']')
                                            .stop(true, true)
                                            .fadeIn(400, function() {
                                                $respTabs.find('.resp-tab-content[aria-labelledby = ' + $tabAria + ']')
                                                    .addClass('resp-tab-content-active');
                                            });
                                    });
                                
                                $respTabs.find("[aria-controls=" + $tabAria + "]")
                                    .addClass('resp-tab-active');
                                moveTabIndicator($respTabs, $indicator);
                            }
                        }
                    });
                    
                    //Window resize function                   
                    $(window).resize(function () {
                        $respTabs.find('.resp-accordion-closed').removeAttr('style');
                    });
                });
            });
        }
    });
})(jQuery);