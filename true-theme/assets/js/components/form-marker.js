/*
 * Form marker to allow css decoration on various states
 *
 */
+function ($) { "use strict";

    var FieldsMarker = function (element, options) {
        var $el = this.$el = $(element)

        this.$group = $el.closest(options.groupClass)
        this.options = options || {}

        this.$group.addClass('is-watching-field')
        this.placeholder = $el.attr('placeholder')

        $el.on('focus', $.proxy(this.onFieldFocus, this))
        $el.on('blur', $.proxy(this.onFieldBlur, this))

        $el.on('keyup change blur', $.proxy(this.onFieldKeyup, this))
        $el.trigger('change')

    }

    FieldsMarker.prototype.onFieldFocus = function(e) {
        this.$group.addClass('is-focused');
    }

    FieldsMarker.prototype.onFieldBlur = function(e) {
        this.$group.removeClass('is-focused');
    }

    FieldsMarker.prototype.onFieldKeyup = function(e) {
        var hasVal = this.$el.val().length && this.$el.val().trim() !== ''

        if (hasVal) this.$group.addClass('has-val');
        else this.$group.removeClass('has-val');
    }

    FieldsMarker.DEFAULTS = {
        groupClass: '.form-group'
    }

    // TRIGGERON PLUGIN DEFINITION
    // ============================

    var old = $.fn.fieldsMarker

    $.fn.fieldsMarker = function (option) {
        return this.each(function () {
            var $this = $(this)
            var data  = $this.data('oc.fieldsMarker')
            var options = $.extend({}, FieldsMarker.DEFAULTS, $this.data(), typeof option == 'object' && option)

            if (!data) $this.data('oc.fieldsMarker', (data = new FieldsMarker(this, options)))
        })
      }

    $.fn.fieldsMarker.Constructor = FieldsMarker

    // TRIGGERON NO CONFLICT
    // =================

    $.fn.fieldsMarker.noConflict = function () {
        $.fn.fieldsMarker = old
        return this
    }

    // TRIGGERON DATA-API
    // ===============

    $(document).ready(function(){
        $('[data-mark-field], .js-mark-field').fieldsMarker()
    })

}(window.jQuery);