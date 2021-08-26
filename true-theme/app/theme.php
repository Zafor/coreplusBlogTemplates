<?php

use Illuminate\Support\Arr;

class TrueTheme
{
    /**
     * Keep this clean, limited to calling functions
     * or adding hooks/filters instead
     * @return [type] [description]
     */
    public static function init()
    {
        self::addACFOptions();
        self::addImageSizes();

        /**
         * Custom global hooks & filters
         */
        // Custom class to body
        add_filter('body_class', [__CLASS__, 'addBodyClass'], 999);
        // Additional item on nav generation, usually used to add dropdown menu
        add_filter('roots_wp_nav_menu_item', [__CLASS__, 'addDropdownMenu'], 999, 3);
        // Modifying class on each nav item. Useful for correcting active class on nav item
        add_filter('nav_menu_css_class', [__CLASS__, 'assignNavActiveClass'], 10, 2);

        add_action('admin_bar_menu', [__CLASS__, 'addPrimeToAdminBar'], 31);

        self::registerShortcodes();
        self::registerSidebars();
        self::registerNavbars();

        self::setupTrialForm();

        self::cleanAdminArea();

        // Add no cache for the homepage
        add_action('template_redirect', function () {
            if (is_front_page()) {
                nocache_headers();
            }
        });

        add_filter('wp_get_attachment_image_attributes', [__CLASS__, 'filterImage'], 10, 3);

        // add_action('init', [__CLASS__, 'startTimer']);
    }

    public static function startTimer()
    {
        global $logwriter;
        $logwriter->info('Init: timestamp: ' . time());
    }

    /**
     * Add Prime menu to Wordpress AdminBar
     */
    public static function addPrimeToAdminBar()
    {
        global $wp_admin_bar;

        $serverStr = '<strong style="font-weight: bold">' . strtoupper(gethostname()) . '</strong>';

        // Show staging area notice
        $args = [
            'id'    => 'true_prime_env_notice',
            'title' => __('<div class="env-notice" style="background-color: #f68933 !important; color: #fff !important; padding-left: 20px; padding-right: 20px;">' . $serverStr . '</div>'),
            'href'  => get_site_url(),
            'meta'  => ['class' => 'prime-env-admin-bar']
        ];
        $wp_admin_bar->add_node($args);
    }

    public static function cleanAdminArea()
    {
        if (current_user_can('edit_pages')) {
            return;
        }

        add_action('admin_menu', function () {
            remove_menu_page('wpcf7');
            remove_menu_page('edit-comments.php');
            remove_menu_page('tools.php');
        });

        add_action('wp_dashboard_setup', function () {
            global $wp_meta_boxes;
            $wp_meta_boxes['dashboard'] = [];
        }, 100);

        add_action('current_screen', function () {
            $author = wp_get_current_user();

            if (isset($author->roles[0])) {
                $current_role = $author->roles[0];
            } else {
                $current_role = 'no_role';
            }

            if ('contributor' == $current_role) {
                $screen = get_current_screen();
                $base   = $screen->id;

                if ('tools' == $base || 'edit-comments' == $base) {
                    wp_die('Cheatin� uh?');
                }
            }
        });
    }

    /**
     * Add options page to ACF
     * @see http://www.advancedcustomfields.com/resources/upgrading-v4-v5/
     */
    public static function addACFOptions()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title'  => 'Global Options',
                'icon_url'    => TrueLib::getImageURL('true-agency-logo.png'),
                'capability' => 'edit_pages',
            ]);

            // Additional options pages goes here
        }
    }

    public static function registerNavbars()
    {
        register_nav_menus([
            'primary_navigation' => __('Primary Navigation', 'roots'),
            'secondary_nav'      => __('Top Navigation', 'roots'),
        ]);
    }

    public static function setupTrialForm()
    {
        add_filter('wpcf7_validate_email*', [__CLASS__, 'trialFormValidateEmail'], 10, 2);
        add_filter('wpcf7_validate_email', [__CLASS__, 'trialFormValidateEmail'], 10, 2);
        add_filter('wpcf7_validate_checkbox', [__CLASS__, 'trialFormValidateCheckbox'], 10, 2);
        add_filter('wpcf7_ajax_json_echo', [__CLASS__, 'addRedirectOnSubmit'], 10, 2);
        add_filter('wpcf7_ajax_json_echo', [__CLASS__, 'formatMessageResponse'], 11, 2);
    }

    /**
     * Add Redirect on Submit
     *
     * @param Array $items
     * @param Form $result
     * @return void
     */
    public static function addRedirectOnSubmit($items, $result)
    {
        $submission = \WPCF7_Submission::get_instance();

        if ($submission != true) {
            return $items;
        }

        $formData = $submission->get_posted_data();

        if (!in_array($formData['_wpcf7'], [12654, 9971, 12985, 14113, 18764, 18857])) {
            return $items;
        }

        if ($items['status'] == 'mail_sent') {
            $promocode = '';
            if (isset($formData['promocode'])) {
                $promocode = $formData['promocode'];
            }
            $response = CoreplusApi::register(stripslashes($formData['first-name']), stripslashes($formData['last-name']), $formData['email'], $promocode);
            // $response = [
            //     'code' => 1,
            //     'url'  => 'https://go.coreplus.com.au/coreplus/',
            // ];

            if (substr($response['url'], 0, 7) === '/trial/') {
                $items['status'] = 'mail_failed';
            }

            if ($response['code'] == 2) {
                $items['invalidFields'][] = [
                    'into'    => 'span.wpcf7-form-control-wrap.email',
                    'message' => 'Invalid email address.'
                ];
                $items['message'] = 'Validation errors occurred. Please confirm the fields and submit it again.';
                $items['status'] = 'validation_failed';
            } else {
                $items['redirect_url'] = $response['url'];
                // $items['onSubmit'][] = 'window.location.href = "' . $response['url'] . '"';
            }
        }

        return $items;
    }

    /**
     * Apply additional formatting to message response output
     *
     * @param Array $items
     * @param Form $result
     * @return void
     */
    public static function formatMessageResponse($response, $result)
    {
        if (!isset($response['message'])) {
            return $response;
        }
        $message = $response['message'];
        // Format special line break shortcode into html <br>
        $message = str_replace('[br]', '<br>', $message);
        $response['message'] = $message;
        return $response;
    }

    public static function trialFormValidateEmail($result, $tag)
    {
        $tag = new WPCF7_FormTag($tag);

        if ('email' == $tag->name) {
            $email = $_POST['email'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $explodedEmail = explode('@', $email);
                $domain = strtolower(array_pop($explodedEmail));

                $blacklist = ['mailed.ro', 'e.wupics.com', 'e.4pet.ro', 'mor19.uu.gl', 'vmail.me', 'e.l5.ca'];

                if (
                    in_array($domain, $blacklist)
                    || strpos('+', $email) !== false
                ) {
                    $result->invalidate($tag, 'Invalid email address');
                }
            }
        }

        return $result;
    }

    public static function trialFormValidateCheckbox($result, $tag)
    {
        $tag = new WPCF7_FormTag($tag);

        if ('checkbox-coreplus-terms' == $tag->name) {
            $acceptance = $_POST['checkbox-coreplus-terms'];
            if (!is_array($acceptance) || count($acceptance) <= 0) {
                $result->invalidate($tag, "You must accept coreplus's Terms of Use and Privacy Policy in order to start your Free Trial");
            }
        }
        if ('checkbox-clickwrap-terms' == $tag->name) {
            $acceptance = $_POST['checkbox-clickwrap-terms'];
            if (!is_array($acceptance) || count($acceptance) <= 0) {
                $result->invalidate($tag, "You must accept coreplus's Clickwrap Licence Agreement in order to start your Free Trial");
            }
        }

        return $result;
    }

    public static function registerSidebars()
    {
        add_action('widgets_init', function () {
            // Footer - Left
            // register_sidebar( array(
            //     'name' => __( 'Footer Sidebar Left', 'theme-slug' ),
            //     'id' => 'footer-sidebar-left',
            //     'description' => __( 'Footer Sidebar - Left.', 'theme-slug' ),
            //     'before_widget' => '<li id="%1$s" class="widget %2$s">',
            //     'after_widget'  => '</li>',
            //     'before_title'  => '<h2 class="widgettitle">',
            //     'after_title'   => '</h2>',
            // ));

            // // Footer - Middle
            // register_sidebar( array(
            //     'name' => __( 'Footer Sidebar Middle', 'theme-slug' ),
            //     'id' => 'footer-sidebar-middle',
            //     'description' => __( 'Footer Sidebar - Middle', 'theme-slug' ),
            //     'before_widget' => '<li id="%1$s" class="widget %2$s">',
            //     'after_widget'  => '</li>',
            //     'before_title'  => '<h2 class="widgettitle">',
            //     'after_title'   => '</h2>',
            // ));

            // // Footer - Right
            // register_sidebar( array(
            //     'name' => __( 'Footer Sidebar Right', 'theme-slug' ),
            //     'id' => 'footer-sidebar-right',
            //     'description' => __( 'Footer Sidebar - Right.', 'theme-slug' ),
            //     'before_widget' => '<li id="%1$s" class="widget %2$s">',
            //     'after_widget'  => '</li>',
            //     'before_title'  => '<h2 class="widgettitle">',
            //     'after_title'   => '</h2>',
            // ));
        });
    }

    /**
     * Create Shortcodes
     *
     */
    public static function registerShortcodes()
    {
        add_shortcode('u', function ($atts, $content = null) {
            return '<span class="shortcode-underline">' . $content . '</span>';
        });

        add_shortcode('b', function ($atts, $content = null) {
            return '<span class="shortcode-bold">' . $content . '</span>';
        });
    }

    /**
     * Register additional image sizes here
     */
    public static function addImageSizes()
    {
        add_image_size('full-width', 1920, 999999);
        add_image_size('half-width', 960, 9999);

        add_image_size('home-banner', 1920, 570);

        add_image_size('home-banner-parallax', 1920, 960);

        add_image_size('home-banner-small', 1920, 350);

        add_image_size('blog-sublisting', 670, 180, true);
        add_image_size('customer-banner', 460, 290, true);

        add_image_size('blog-image-banner', 1200, 99999);
        add_image_size('main-banner-overlay', 626, 480, true);
    }

    /**
     * Hook into roots_nav filters, useful for adding mega menu dropdown
     *
     * @param [type] $html    HTML string of the menut
     * @param [type] $item    WP Nav object
     * @param [type] $post_id The ID of the page/post that the nav links to
     */
    public static function addDropdownMenu($html, $item, $post_id)
    {
        return $html;
    }

    /**
     * Add our own body classes if needed
     *
     * @param array $classes
     */
    public static function addBodyClass($classes)
    {
        return $classes;
    }

    /**
     * Correcting current active class, hook into 'nav_menu_css_class'
     * @param  array
     * @param  Object
     * @return [type]
     */
    public static function assignNavActiveClass($classes, $item)
    {
        // Remove active class when on search page
        if (is_search()) {
            $classes = str_replace(['active'], '', $classes);
        }

        return $classes;
    }

    /**
     * Filter image to enable lazy-loading capability
     * To be used in conjunction with lazy-load javascript
     * @link https://github.com/verlok/lazyload
     *
     * @param array $attr
     * @param array $attachment
     * @param array $size
     * @return void
     */
    public static function filterImage($attr, $attachment, $size)
    {
        if (is_admin()) {
            return $attr;
        }
        $cssClass = Arr::get($attr, 'class', '');
        if (strpos($cssClass, 'lazy') !== false) {
            // Prefix srcset and sizes to data-*
            foreach (['src', 'srcset', 'sizes'] as $key) {
                if (!isset($attr[$key])) {
                    continue;
                }
                $attr['data-' . $key] = $attr[$key];
                unset($attr[$key]);
            }
        }
        return $attr;
    }
}

TrueTheme::init();
