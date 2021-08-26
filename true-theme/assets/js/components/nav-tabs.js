/*
 * NavTabs Tooltip
 */

+function ($) { "use strict";

    // NavTabs CLASS DEFINITION
    // ============================

    var NavTabs = function(element, options) {
        var self         = this;
        this.options     = options;
        this.el          = element;
        this.$el         = $(element);
        this.init();
    }

    NavTabs.DEFAULTS = {
        tabActiveCss: 'tw-bg-primary tw-text-white hover:tw-text-white focus:tw-text-white',
        tabInactiveCss: 'tw-bg-white tw-text-gray-800 hover:tw-text-900 focus:tw-text-900 hover:tw-bg-gray-200',
        collapseActiveCss: '',
        collapseInactiveCss: '',
    }

    /**
     * On Init
     */
    NavTabs.prototype.init = function() {
        this.$el
          .find('a[data-toggle="tab"]').on('shown.bs.tab', (e) => {
              this.decorateTab(e.target, true)
              this.decorateTab(e.relatedTarget, false)
          })
        this.$el.find('[role="tablist"] > li').each((index, el) => {
            if ($(el).hasClass('active')) {
                this.decorateTab($(el).find('a'), true)
            } else {
                this.decorateTab($(el).find('a'), false)
            }
        })
        this.$el.find('.collapse').each((index, el) => {
            let $collapse = $(el)
            let id = $collapse.attr('id')
            let $toggle = this.$el.find(`[href="#${id}"]`)
            $collapse.on('shown.bs.collapse', () => {
                $toggle.find('.js-collapse-indicator')
                    .get(0)
                    .classList.add('tw-rotate-180')
            })
            $collapse.on('hidden.bs.collapse', () => {
                $toggle.find('.js-collapse-indicator')
                    .get(0)
                    .classList.remove('tw-rotate-180')
            })
        })
    }

    NavTabs.prototype.decorateTab = function(el, isActive) {
        if (isActive) {
            $(el)
                .removeClass(this.options.tabInactiveCss)
                .addClass(this.options.tabActiveCss)
            return
        }
        $(el)
            .removeClass(this.options.tabActiveCss)
            .addClass(this.options.tabInactiveCss)
    }

    // NavTabs PLUGIN DEFINITION
    // ============================

    $.fn.navTabs = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('trueper.navTabs')
            var options = $.extend({}, NavTabs.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('trueper.navTabs', (data = new NavTabs(this, options)))
            else if (typeof option == 'string') data[option].apply(data, args)
        })
    }

    $.fn.navTabs.Constructor = NavTabs

    // DeleteActivity DATA-API
    // ===============

    $(document).on('ready', function () {
        $('[data-control="nav-tabs"]').navTabs();
    });

}(window.jQuery);
