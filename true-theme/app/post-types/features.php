<?php    
    
    class TrueFeatures
    {
        /* -------------------------------------------------- */
        /* Edit these variables
        /* -------------------------------------------------- */
        private static $ref = 'TrueFeatures'; //Name of the post type, needed for callbacks
        private static $postType = 'true_feature';
        private static $singleName = 'Feature';
        private static $pluralName = 'Features';
        private static $slug = 'features';
        private static $templateName = 'page-features';
        private static $menuImage = 'trueFeaturesWPIcons';
            
        public static function getTabs()
        {
            $posts = self::getAll();
            
            return $posts;
        }

        static function getTabsByProfession($professionID)
        {
            $args = array(
                'post_type' => self::$postType,
                'posts_per_page' => -1,
                'orderby' => 'meta_value_num',
                'meta_key' => 'sort_order',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => TrueAddon::$taxName,
                        'field'    => 'id',
                        'terms'    => $professionID,
                    ),
                )
            );
            $posts = get_posts($args);

            return $posts;
        }
                
        public static function getCurrentTab(&$tabs)
        {
            $currentTab = get_the_id();
            
            if($currentTab == FEATURES_PAGE_ID)
            {
                if(count($tabs) > 0)
                {
                    return $tabs[0];
                } else {
                    return null;
                }
            } else {
                foreach($tabs as $tab)
                {
                    if($tab->ID == $currentTab)
                    {
                        return $tab;
                    }
                } 
            }
        }
                
        private static function get($id)
        {
            $object = get_post($id);
            $result = array();
            if($object)
            {
                if($object->post_type == self::$postType)
                {
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
                            'orderby' => 'meta_value_num',
                            'meta_key' => 'sort_order',
                            'order' => 'ASC',
                        );
                        
            if($ids != null)
            {
                $args['include'] = $ids;
            }
            
            $objects = get_posts($args);

            $result = array();
            if(count($objects) > 0)
            {                        
                foreach($objects as $object)
                {
                    $result[] = $object;  
                }
            } 
            
            return $result;
        }
        
       
        /* -------------------------------------------------- */
        /* Add all Wordpress hooks here
        /* -------------------------------------------------- */
        static function init()
        {
            add_action('init', array(self::$ref, 'createPostType'));
            if(trim(self::$slug) != '')
            {
                add_filter( 'template_include', array(self::$ref, 'includeTemplate'), 1 );
            }
            
            //self::customFunctions();
        }
        
        /* -------------------------------------------------- */
        /* Create Post Type
        /* -------------------------------------------------- */
        static function createPostType()
        {
            $args = array(
                    'labels' => array(
                        'name' => __( self::$pluralName, THEME_NAME),
                        'singular_name' => __( self::$singleName, THEME_NAME),
                        'add_new_item'  => __( 'New ' . self::$singleName, THEME_NAME),
                        'add_new'             => __( 'New ' . self::$singleName, THEME_NAME),
                        'edit_item'           => __( 'Edit ' . self::$singleName, THEME_NAME),
                        'update_item'         => __( 'Update ' . self::$singleName, THEME_NAME),
                        'search_items'        => __( 'Search ' . self::$pluralName, THEME_NAME),
                        'not_found'           => __( 'No ' . self::$pluralName . ' found', THEME_NAME),
                        'not_found_in_trash'  => __( 'No ' . self::$pluralName . ' found in Trash', THEME_NAME),
                    ),
                'public' => true,
                'show_ui' => true,
                'menu_icon' => TrueLib::getImageURL('true-icons/' . self::$menuImage . '.png'),
                'supports' => array('title'),
                'exclude_from_search' => true,
                'has_archive'         => false,
                'capability_type'     => 'page'
            );
                
                
            if(trim(self::$slug) != '')
            {
                $args['rewrite'] = array('slug' => self::$slug, 'with_front' => false);
                add_filter( 'template_include', array(self::$ref, 'includeTemplate'), 1 );
            } else {
                $args['rewrite'] = false;
            }
            
            register_post_type( self::$postType, $args);
        }

        static function includeTemplate( $template_path ) 
        {
            if ( get_post_type() == self::$postType) 
            {
                if ( is_single() ) 
                {
                    if ( $theme_file = locate_template( array ( 'page-templates/' . self::$templateName . '.php' ) ) ) 
                    {
                        $template_path = $theme_file;
                    }
                }
            }
            return $template_path;
        }
        
    }

    TrueFeatures::init();
