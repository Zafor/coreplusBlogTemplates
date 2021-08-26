
/* Retina.js */
;
(function() {
    function n() {}

    function r(e, t) {
        this.path = e;
        if (typeof t !== "undefined" && t !== null) {
            this.at_2x_path = t;
            this.perform_check = false
        } else {
            this.at_2x_path = e.replace(/\.\w+$/, function(e) {
                return "@2x" + e
            });
            this.perform_check = true
        }
    }

    function i(e) {
        this.el = e;
        this.path = new r(this.el.getAttribute("src"), this.el.getAttribute("data-at2x"));
        var t = this;
        this.path.check_2x_variant(function(e) {
            if (e) t.swap()
        })
    }
    var e = typeof exports == "undefined" ? window : exports;
    var t = {
        check_mime_type: true
    };
    e.Retina = n;
    n.configure = function(e) {
        if (e == null) e = {};
        for (var n in e) t[n] = e[n]
    };
    n.init = function(t) {
        if (t == null) t = e;
        var r = t.onload || new Function;
        t.onload = function() {
            var e = document.getElementsByTagName("img"),
                t = [],
                s, o;
            for (s = 0; s < e.length; s++) {
                o = e[s];
                if (n.hasClass(o, "retina-image")) {
                    t.push(new i(o))
                }
            }
            r()
        }
    };
    n.hasClass = function(e, t) {
        return (" " + e.className + " ").indexOf(" " + t + " ") > -1
    };
    n.isRetina = function() {
        var t = "(-webkit-min-device-pixel-ratio: 1.5),                      (min--moz-device-pixel-ratio: 1.5),                      (-o-min-device-pixel-ratio: 3/2),                      (min-resolution: 1.5dppx)";
        if (e.devicePixelRatio > 1) return true;
        if (e.matchMedia && e.matchMedia(t).matches) return true;
        return false
    };
    e.RetinaImagePath = r;
    r.confirmed_paths = [];
    r.prototype.is_external = function() {
        return !!(this.path.match(/^https?\:/i) && !this.path.match("//" + document.domain))
    };
    r.prototype.check_2x_variant = function(e) {
        var n, i = this;
        if (!this.perform_check && typeof this.at_2x_path !== "undefined" && this.at_2x_path !== null) {
            return e(true)
        } else if (this.at_2x_path in r.confirmed_paths) {
            return e(true)
        } else {
            n = new XMLHttpRequest;
            n.open("HEAD", this.at_2x_path);
            n.onreadystatechange = function() {
                if (n.readyState != 4) {
                    return e(false)
                }
                if (n.status >= 200 && n.status <= 399) {
                    if (t.check_mime_type) {
                        var s = n.getResponseHeader("Content-Type");
                        if (s == null || !s.match(/^image/i)) {
                            return e(false)
                        }
                    }
                    r.confirmed_paths.push(i.at_2x_path);
                    return e(true)
                } else {
                    return e(false)
                }
            };
            n.send()
        }
    };
    e.RetinaImage = i;
    i.prototype.swap = function(e) {
        function n() {
            if (!t.el.complete) {
                setTimeout(n, 5)
            } else {
                t.el.setAttribute("width", t.el.offsetWidth);
                t.el.setAttribute("height", t.el.offsetHeight);
                t.el.setAttribute("src", e)
            }
        }
        if (typeof e == "undefined") e = this.path.at_2x_path;
        var t = this;
        n()
    };
    if (n.isRetina()) {
        n.init(e)
    }
})();
/*! jQuery Placeholder Enhanced 1.6.9 | @tdecs | under the MIT license */
!function(e,a){"use strict";var l="placeholderEnhanced",s=a.createElement("input"),t=a.createElement("textarea"),n="placeholder"in s&&"placeholder"in t,r={FOCUS:"focus.placeholder",BLUR:"blur.placeholder"},o={cssClass:"placeholder",normalize:!0},c=e.fn.val,i=function(a){return e.nodeName(a,"input")||e.nodeName(a,"textarea")},d=function(a){for(var l,s=["placeholder","name","id"],t={},n=0,r=a.attributes.length;r>n;n++)l=a.attributes[n],l.specified&&e.inArray(l.name,s)<0&&(t[l.name]=l.value);return t},u=function(e){e.css({position:"",left:""})},p=function(e){e.css({position:"absolute",left:"-9999em"})};(!n||o.normalize)&&(n?n&&o.normalize&&(e.fn.val=function(){var a=arguments,s=this[0];return s?a.length?this.each(function(s,t){var n=e(t),r=e.data(t,l),o=t._placeholder;r&&o&&i(t)&&(a[0]||t.value===o?a[0]&&n.hasClass(r.cssClass)&&n.removeClass(r.cssClass):n.addClass(r.cssClass).attr("placeholder",o)),c.apply(n,a)}):c.apply(this,a):void 0}):e.fn.val=function(){var a,s=arguments,t=this[0];return t?s.length?this.each(function(a,t){var n=e(t),r=e.data(t,l),o=n.attr("placeholder");r&&o&&i(t)?s[0]||t.value===o?s[0]&&(n.hasClass(r.cssClass)&&n.removeClass(r.cssClass),c.apply(n,s)):t.value=n.addClass(r.cssClass).attr("placeholder"):c.apply(n,s)}):(a=e(t).attr("placeholder"),a&&i(t)?t.value===a?"":t.value:c.apply(this,s)):void 0},e.fn[l]=function(a){var s=e.extend(o,a);if(this.length&&(!n||s.normalize))return"destroy"===a?this.filter(function(a,s){return e.data(s,l)}).removeClass(s.cssClass).each(function(a,s){var t=e(s).unbind(".placeholder"),r="password"===s.type,o=t.attr("placeholder");n?delete s._placeholder:(s.value===o&&(s.value=""),r&&(u(t),t.prev().unbind(".placeholder").remove())),e.fn.val=c,e.removeData(s,l)}):this.each(function(a,t){if(!e.data(t,l)){e.data(t,l,s);var o=e(t),c="password"===t.type,i=o.attr("placeholder"),h=null,v=null,f=null;n?n&&s.normalize&&(t._placeholder=o.attr("placeholder"),v=function(){t.value||o.addClass(s.cssClass).attr("placeholder",i)},f=function(){o.removeAttr("placeholder").removeClass(s.cssClass)}):(v=function(){o.val()?o.val()&&c&&f():c?(u(h),p(o)):o.val(i).addClass(s.cssClass)},c?(f=function(){u(o),p(h)},h=e("<input>",e.extend(d(t),{type:"text",value:i,tabindex:-1})).addClass(s.cssClass).bind(r.FOCUS,function(){o.trigger(r.FOCUS)}).insertBefore(o)):f=function(){o.hasClass(s.cssClass)&&(t.value="",o.removeClass(s.cssClass))}),o.bind(r.BLUR,v).bind(r.FOCUS,f).trigger(r.BLUR)}})},e(function(){e("input[placeholder], textarea[placeholder]")[l]()}))}(jQuery,document)

var TrueLib = null;
var $window = null;
jQuery( document ).ready(function( $ )
{
    $window = $(window);
    /* TrueLib! All new! */
    TrueLib = {
        isPage: function(page)
        {
            if(jQuery('body').hasClass(page))
            {
                return true;
            }
            return false;
        },
        scrollTo: function(pos, length, delay)
        {
            delay = (typeof delay === "undefined") ? 0 : delay;
            length = (typeof length === "undefined") ? 1000 : length;
            $('html, body').stop(true).delay(delay).animate({
                scrollTop: pos
            }, length);
        },
        viewport: function()
        {
            var e = window, a = 'inner';
            if (!('innerWidth' in window )) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
        },
        windowWidth: function()
        {
            return this.viewport().width;
        },
        windowHeight: function()
        {
            return this.viewport().height;
        },
        isMobileWidth: function()
        {
            if (this.viewport().width <= 767)
                return true;
            return false;
        },
        isTabletWidth: function()
        {
            if (this.viewport().width <= 939)
                return true;
            return false;
        },
    }

    var TrueBrowserDetect = {
        isFirefox : false,
        isOpera : false,
        isWebkit : false,
        isChrome : false,
        isIE10 : false,
        isIE11 : false,
        isSafari : false,
        isMobile : false,
        isTablet : false,
        init: function()
        {
            this.isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
            //Chrome
            this.isChrome = !!window.chrome && !this.isOpera;
            if(this.isChrome) { jQuery('html').addClass('chrome'); }

            //Firefox
            this.isFirefox = typeof InstallTrigger !== 'undefined';
            if(this.isFirefox) { jQuery('html').addClass('firefox'); }

            //Webkit
            this.isWebkit = /webkit/.test(navigator.userAgent.toLowerCase());
            if(this.isWebkit) { jQuery('html').addClass('webkit'); }

            //Safari
            this.isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
            if(this.isSafari) { jQuery('html').addClass('safari'); }

            //IE 10
            if(this.isIE(10)) { jQuery('html').addClass('ie10'); jQuery('html').addClass('ie'); }

            this.isMobile = this.checkMobile();
            this.isTablet = this.checkTablet();

            this.isIE11 = !!navigator.userAgent.match(/Trident\/7\./);
            if(this.isIE11) { jQuery('html').addClass('ie11');jQuery('html').addClass('ie'); }
        },

        isIE: function(v)
        {
            var r = RegExp('msie' + (!isNaN(v) ? ('\\s' + v) : ''), 'i');
            return r.test(navigator.userAgent);
        },

        checkMobile: function()
        {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        },

        checkTablet: function()
        {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        }

    }
    TrueBrowserDetect.init();


});
