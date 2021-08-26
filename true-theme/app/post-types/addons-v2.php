<?php
    
    class TrueAddonV2
    {
        /* -------------------------------------------------- */
        /* Edit these variables
        /* -------------------------------------------------- */
        private static $postType = 'true_addon_v2';
        private static $singleName = 'Addon';
        private static $pluralName = 'Addons';
        private static $slug = 'add-ons';
        private static $templateName = 'single-addon';
        private static $menuImage = 'trueAddOnWPIcons';

        //Taxonomy Details
        public static $hasTax = true;
        public static $taxName = 'true_category_tax';
        public static $taxSingleName = 'Category';
        public static $taxPluralName = 'Categories';
        public static $taxSlug = 'addon-category';
               
        
        public static function getCategories()
        {
            return get_terms(self::$taxName, array('hide_empty' => false, 'parent' => 0));
        }

        public static function getAddonsByCategory($categoryId)
        {
            $args = array(
                'post_type' => TrueAddonV2::$postType,
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => TrueAddonV2::$taxName,
                        'field'    => 'id',
                        'terms'    => $categoryId,
                        'include_children' => false
                    ),
                )
            );
            $posts = get_posts($args);

            return $posts;
        }
        
        /* -------------------------------------------------- */
        /* Add all Wordpress hooks here
        /* -------------------------------------------------- */
        public static function init()
        {
            add_action('init', array(__CLASS__, 'createPostType'));
            
            if (trim(self::$slug) != '') {
                add_filter('template_include', array(__CLASS__, 'includeTemplate'), 1);
            }
            
            //self::customFunctions();
        }
        
        
        private static function get($id)
        {
            $object = get_post($id);
            $result = array();
            if ($object) {
                if ($object->post_type == self::$postType) {
                    $object = $object;
                } else {
                    $object = null;
                }
            }
            
            return $object;
        }
        
        private static function getAll($ids = null)
        {
            $args = array(  'post_type' => self::$postType,
                            'numberposts' => -1,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'ASC',
                        );
                        
            if ($ids != null) {
                $args['include'] = $ids;
            }
            
            $objects = get_posts($args);

            $result = array();
            if (count($objects) > 0) {
                foreach ($objects as $object) {
                    $result[] = $object;
                }
            }
            
            return $result;
        }
        
        
        /* -------------------------------------------------- */
        /* Create Post Type
        /* -------------------------------------------------- */
        public static function createPostType()
        {
            $args = array(
                    'labels' => array(
                        'name' => __(self::$pluralName, THEME_NAME),
                        'singular_name' => __(self::$singleName, THEME_NAME),
                        'add_new_item'  => __('New ' . self::$singleName, THEME_NAME),
                        'add_new'             => __('New ' . self::$singleName, THEME_NAME),
                        'edit_item'           => __('Edit ' . self::$singleName, THEME_NAME),
                        'update_item'         => __('Update ' . self::$singleName, THEME_NAME),
                        'search_items'        => __('Search ' . self::$pluralName, THEME_NAME),
                        'not_found'           => __('No ' . self::$pluralName . ' found', THEME_NAME),
                        'not_found_in_trash'  => __('No ' . self::$pluralName . ' found in Trash', THEME_NAME),
                    ),
                'public' => true,
                'show_ui' => true,
                'menu_icon' => TrueLib::getImageURL('true-icons/' . self::$menuImage . '.png'),
                'supports' => array('title'),
                'exclude_from_search' => false,
                'has_archive'         => false,
                'capability_type'     => 'page'
            );
                
                
            if (trim(self::$slug) != '') {
                $args['rewrite'] = array('slug' => self::$slug, 'with_front' => false);
                add_filter('template_include', array(__CLASS__, 'includeTemplate'), 1);
            } else {
                $args['rewrite'] = false;
            }
            
            register_post_type(self::$postType, $args);

            if (self::$hasTax) {
                self::createTaxonomy();
            }
        }

        public static function createTaxonomy()
        {
            // Register Custom Taxonomy
            $labels = array(
                'name'                       => _x(self::$taxPluralName, 'Taxonomy General Name', 'text_domain'),
                'singular_name'              => _x(self::$taxSingleName, 'Taxonomy Singular Name', 'text_domain'),
                'menu_name'                  => __(self::$taxPluralName, 'text_domain'),
                'all_items'                  => __(self::$taxPluralName, 'text_domain'),
                'parent_item'                => __('Parent ' . self::$taxSingleName, 'text_domain'),
                'parent_item_colon'          => __('Parent ' . self::$taxPluralName . ':', 'text_domain'),
                'new_item_name'              => __('New ' . self::$taxSingleName, 'text_domain'),
                'add_new_item'               => __('Add New ' . self::$taxSingleName, 'text_domain'),
                'edit_item'                  => __('Edit ' . self::$taxSingleName, 'text_domain'),
                'update_item'                => __('Update ' . self::$taxSingleName, 'text_domain'),
                'separate_items_with_commas' => __('Separate ' . self::$taxPluralName . ' with commas', 'text_domain'),
                'search_items'               => __('Search ' . self::$taxPluralName, 'text_domain'),
                'add_or_remove_items'        => __('Add or remove ' . self::$taxPluralName, 'text_domain'),
                'choose_from_most_used'      => __('Choose from the most used ' . self::$taxPluralName, 'text_domain'),
            );
        
            $args = array(
                'labels'                     => $labels,
                'hierarchical'               => true,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'rewrite'                    => array('with_front'=> true, 'slug' => self::$taxSlug),
                'show_tagcloud'              => false,
            );
        
            register_taxonomy(self::$taxName, self::$postType, $args);
        }

        public static function includeTemplate($template_path)
        {
            if (get_post_type() == self::$postType) {
                if (is_single()) {
                    if ($theme_file = locate_template(array( 'page-templates/' . self::$templateName . '.php' ))) {
                        $template_path = $theme_file;
                    }
                }
            }
            
            return $template_path;
        }
    }

    TrueAddonV2::init();
