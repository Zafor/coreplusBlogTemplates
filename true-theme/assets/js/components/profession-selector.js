/*
 * Profession Selector Form Plugin
 *
 *
 */

+function ($) { "use strict";

    // ProfessionSelector CLASS DEFINITION
    // ============================

    var ProfessionSelector = function(element, options) {
        var self         = this;
        this.options     = options;
        this.el          = element;
        this.$el         = $(element);
        this.$popup      = this.$el.find('.profession-selector-popup');
        this.$form       = this.$el.find('.profession-selector-popup form');
        this.$header     = $('.header-top-bar');

        this.$loader     = this.$el.find('.profession-selector-dialog__loader');
        this.animationQueues = [];

        this.init();
    }

    ProfessionSelector.DEFAULTS = { }

    /**
     * On Init
     *
     */
    ProfessionSelector.prototype.init = function() {
        var self = this;

        //Bar related
        self.$el.find('.profession-selector__close').click($.proxy(self.hideBar, this));
        self.$el.find('.profession-selector__content .shortcode-underline').click($.proxy(self.showPopup, this));
        self.$header.find('.header-top-bar__left .shortcode-underline').click($.proxy(self.showPopup, this));
        // Footer Trigger
        $('[data-profession-trigger]').click($.proxy(self.showPopup, this));

        //Popup Related
        self.$el.find('.profession-selector-dialog__close').click($.proxy(self.hidePopup, this));

        self.$popup.find('.profession-selector-dialog__choices a').click(function(e)
        {
            e.preventDefault();

            self.$popup
                .find('.profession-selector-dialog__choices a')
                .removeClass('active');

            $(this).toggleClass('active');

            self.submitForm();
            return false;
        });

        self.$form.on('submit', $.proxy(self.submitForm, this));
    }

    /**
     * Hide the profession bar at the top of the page
     *
     */
    ProfessionSelector.prototype.hideBar = function()
    {
        this.$el.stop(true, true)
            .slideUp();
    }

    ProfessionSelector.prototype.submitForm = function()
    {
        var self = this;

        self.$loader.fadeIn();
        
        var professionId = self.$popup.find('.profession-selector-dialog__choices a.active').data('id');
        
        $.ajax({
            data: {
                action: 'set_profession',
                profession: professionId
            },
            method: 'POST',
            url: ajax_object.ajax_url, 
            success: function(result){
                if(typeof ga !== 'undefined') {
                    ga('send', {
                        hitType: 'event',
                        eventCategory: 'ProfessionSelect',
                        eventAction: 'select',
                        eventLabel: self.$popup.find('.profession-selector-dialog__choices a.active').text()
                    });
                }
                window.location.href = self.$popup.find('.profession-selector-dialog__choices a.active').attr('href');
            }
        });
        //App.Common.createCookie('current_profession', self.$form.find('input[type="hidden"]').val(), 2000);
        //window.location.href = '/';
        
        return false;
    }
    
    ProfessionSelector.prototype.makeId = function() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      
        for (var i = 0; i < 5; i++)
          text += possible.charAt(Math.floor(Math.random() * possible.length));
      
        return text;
      }

    /**
     * Show the Popup
     *
     */
    ProfessionSelector.prototype.showPopup = function()
    {
        var self = this;

        $('body').addClass('lock-scroll');
        this.$popup.stop(true, true)
            .fadeIn(function()
            {
                
            })
            .find('.profession-selector-dialog')
            .addClass('do-animation');

        $.each(self.animationQueues, function(index, interval)
        {
            clearTimeout(interval);
        });

        self.animationQueues = [];

        var delay = 0;
        //Remove the animation class and add it
        self.$popup.find('.profession-selector-dialog__choices li a')
            .removeClass('do-animation')
            .each(function()
            {
                var $menuItem = $(this);
                self.animationQueues.push(setTimeout(function()
                {
                    $menuItem.addClass('do-animation');
                }, delay));

                delay += 100;
            });
    }

    /**
     * Show the Popup
     *
     */
    ProfessionSelector.prototype.hidePopup = function()
    {
        var self = this;

        self.$popup.find('.profession-selector-dialog')
            .removeClass('do-animation');

        $('body').removeClass('lock-scroll');

        self.$popup.stop(true, true)
            .fadeOut(function()
                {
                    self.$popup.find('.profession-selector-dialog__choices li a')
                        .removeClass('do-animation')
                });
    }

    // ProfessionSelector PLUGIN DEFINITION
    // ============================

    $.fn.professionSelector = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('trueper.profession-selector')
            var options = $.extend({}, ProfessionSelector.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('trueper.profession-selector', (data = new ProfessionSelector(this, options)))
            else if (typeof option == 'string') data[option].apply(data, args)
        })
    }

    $.fn.professionSelector.Constructor = ProfessionSelector

    // DeleteActivity DATA-API
    // ===============

    $(document).on('ready', function () {
        $('[data-control="profession-selector"]').professionSelector();
    });

}(window.jQuery);
