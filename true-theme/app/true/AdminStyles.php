<?php
    /* -------------------------------------------------- */
    /* AdminStyles
    /* -------------------------------------------------- */
    /*
     * Custom styling on various sections in WP admin area
     */
    class AdminStyles
    {
        private static $loadedCustomACFStyle = false; // Make sure only loaded max once

        public static function init()
        {
            if (is_admin()) {
                // ACF Hooks
                add_filter('acf/render_field/type=message', array(__CLASS__, 'customACFStyle'), 8, 1);
                add_filter('acf/render_field/type=image', array(__CLASS__, 'customACFStyle'), 8, 1);
                add_filter('acf/load_field/type=image', array(__CLASS__, 'renderSize'));

                add_action('admin_menu', array(__CLASS__, 'removeMetaBoxes'));
            }

            // Login
            add_action('login_head', array(__CLASS__, 'loginStyles'));

            // Admin footer
            add_filter('admin_footer_text', array(__CLASS__, 'coreplusFooter'));
        }

        public static function removeMetaBoxes()
        {
            //Hide metaboxes
            remove_meta_box('revisionsdiv', 'page', 'normal');
            remove_meta_box('commentstatusdiv', 'page', 'normal');
            remove_meta_box('dashboard_activity', 'dashboard', 'normal');
            remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
        }

        public static function coreplusFooter()
        {
            ?>
            Coreplus
            <?php
        }

        /**
         * Show recommended size in prettier way
         *
         * Usage: [widthxheight]
         * E.g.: [300x500]
         *
         */
        public static function renderSize($field)
        {
            preg_match_all("/\[(.*?)\]/", $field['instructions'], $matches);

            if (count($matches) > 1) {
                if (count($matches[1]) > 0) {
                    $match = $matches[1][0];
                    $orig = '['.$match.']';

                    $sizeArr = explode('x', $match);
                    if (count($sizeArr) !== 2) {
                        return $field;
                    }
                    $width = $sizeArr[0];
                    $height = $sizeArr[1];

                    $render = '<span class="acf-recommended-size"> <span>'.$width.'px</span><span>'.$height.'px</span></span>';
                    $field['instructions'] = str_replace($orig, $render, $field['instructions']);
                }
            }

            return $field;
        }

        /**
         * Custom admin styling for login
         *
         * @return [type] [description]
         */
        public static function loginStyles()
        {
            ?>
            <style type="text/css">
                body {
                    position: relative;
                    background-color: #fff;
                    background-position: bottom center;
                    background-repeat: no-repeat;
                }
                h1 a
                {
                    /** Change width and height according to logo */
                    width:200px !important; height:100px !important;
                    background: url('<?=TrueLib::getImageURL('logoLogin.png')?>') no-repeat center center !important;
                    -webkit-background-size: auto auto !important; background-size: auto auto !important;
                }
            </style>
            <?php
        }

        public static function customACFStyle()
        {
            if (defined('DOING_AJAX') && DOING_AJAX) {
                return;
            }

            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
                return;
            }

            if (!self::$loadedCustomACFStyle) {
                ?>
                <style>
                .acf-field.field_type-message {
                    padding: 15px 0px 0px !important;
                    width: 100%;
                }
                .acf-field.field_type-message .acf-label {
                    margin-bottom: 0px; display: inline-block; padding: 5px 10px; background-color: rgba(59, 150, 170, 1); color: #fff;
                }
                .acf-field.field_type-message .acf-input h4,
                .acf-field.field_type-message .acf-input h5,
                .acf-field.field_type-message .acf-input p
                 {
                    margin-top: 0px; margin-bottom: 0px;
                    padding: 10px 15px; background-color: #2DA7AD; color: #fff;
                }
                span.acf-recommended-size {
                    background-color: #3498db; color: #fff; position: relative; display: inline-block;
                    padding: 0px 0px 0px 30px; margin-top: 10px;
                    line-height: 30px; height: 30px; padding-bottom: 0px;
                    -webkit-transition: padding-bottom 0.2s ease; -o-transition: padding-bottom 0.2s ease; transition: padding-bottom 0.2s ease;
                }

                span.acf-recommended-size:before {
                    position: absolute; content: '';
                    width: 30px; height: 30px;
                    background-image: url("<?= TrueLib::getImageURL('common/icon-size.png') ?>");
                    background-position: center center; background-repeat: no-repeat;
                    top: 0px; left: 0px;
                    background-color: #2980b9;
                     -webkit-transition: padding-bottom 0.2s ease; -o-transition: padding-bottom 0.2s ease; transition: padding-bottom 0.2s ease;
                }

                @media only screen and (-webkit-min-device-pixel-ratio: 2),
                only screen and (   min--moz-device-pixel-ratio: 2),
                only screen and (     -o-min-device-pixel-ratio: 2/1),
                only screen and (        min-device-pixel-ratio: 2),
                only screen and (                min-resolution: 192dpi),
                only screen and (                min-resolution: 2dppx) {
                    span.acf-recommended-size:before {
                        background-image: url("<?= TrueLib::getImageURL('common/icon-size.png') ?>");
                        background-size: 25px 25px;
                        -webkit-background-size: 25px 25px;
                    }
                }
                span.acf-recommended-size > span {
                    line-height: 30px; height: 30px; width: 50px; text-align: center;
                    display: inline-block; position: relative;
                }

                span.acf-recommended-size > span:before {
                    position: absolute; content: 'Width';
                    line-height: 24px; height: 24px; width: 50px; text-align: center;
                    bottom: -24px; left: 0px; width: 50px;
                    background-color: #1abc9c; opacity: 0;
                    -webkit-transition: opacity 0.2s ease 0s; -o-transition: opacity 0.2s ease 0s; transition: opacity 0.2s ease 0s;
                }

                span.acf-recommended-size > span + span {
                    background-color: #52ADEA;
                }

                span.acf-recommended-size > span + span:before {
                    background-color: #37BCA1; content: 'Height';
                }

                span.acf-recommended-size:hover {
                    padding-bottom: 24px;
                }

                span.acf-recommended-size:hover:before {
                    padding-bottom: 24px;
                }
                span.acf-recommended-size:hover > span:before {
                    opacity: 1;
                    -webkit-transition: opacity 0.2s ease 0.08s; -o-transition: opacity 0.2s ease 0.08s; transition: opacity 0.2s ease 0.08s;
                }
                </style>
            <?php
            }
            self::$loadedCustomACFStyle = true;
        }
    }

    AdminStyles::init();
