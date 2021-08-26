<?php    
    
    class TrueProduct
    {
        /* -------------------------------------------------- */
        /* Edit these variables
        /* -------------------------------------------------- */
        private static $postType = 'true_product';
        private static $singleName = 'Product';
        private static $pluralName = 'Products';
        private static $slug = 'product';
        private static $templateName = 'single-product';
        private static $menuImage = 'trueKeylockWPIcons';

        //Taxonomy Details
        public static $hasTax = false;
        public static $taxName = 'true_product_tax';   
        public static $taxSlug = 'products';
                       
        
        /* -------------------------------------------------- */
        /* Add all Wordpress hooks here
        /* -------------------------------------------------- */
        static function init()
        {
            add_action('init', array(__CLASS__, 'createPostType'));
            
            if(trim(self::$slug) != '')
            {
                add_filter( 'template_include', array(__CLASS__, 'includeTemplate'), 1 );
            }
            
            //self::customFunctions();
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
                            'orderby' => 'date',
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
        /* Create Post Type
        /* -------------------------------------------------- */
        static function createPostType()
        {
            $args = array(
                    'labels' => array(
                        'name' => __( self::$pluralName, Config::THEME_NAME),
                        'singular_name' => __( self::$singleName, Config::THEME_NAME),
                        'add_new_item'  => __( 'New ' . self::$singleName, Config::THEME_NAME),
                        'add_new'             => __( 'New ' . self::$singleName, Config::THEME_NAME),
                        'edit_item'           => __( 'Edit ' . self::$singleName, Config::THEME_NAME),
                        'update_item'         => __( 'Update ' . self::$singleName, Config::THEME_NAME),
                        'search_items'        => __( 'Search ' . self::$pluralName, Config::THEME_NAME),
                        'not_found'           => __( 'No ' . self::$pluralName . ' found', Config::THEME_NAME),
                        'not_found_in_trash'  => __( 'No ' . self::$pluralName . ' found in Trash', Config::THEME_NAME),
                    ),
                'public' => true,
                'show_ui' => true,
                'menu_icon' => TrueLib::getImageURL('true-icons/' . self::$menuImage . '.png'),
                'supports' => array('title'),
                'exclude_from_search' => false,
                'has_archive'         => false,
            );
                
                
            if(trim(self::$slug) != '')
            {
                $args['rewrite'] = array('slug' => self::$slug, 'with_front' => false);
                add_filter( 'template_include', array(__CLASS__, 'includeTemplate'), 1 );
            } else {
                $args['rewrite'] = false;
            }
            
            register_post_type( self::$postType, $args);

            if(self::$hasTax)
            {
                self::createTaxonomy();
            }
        }

        static function createTaxonomy()
        {
            // Register Custom Taxonomy
            $labels = array(
                'name'                       => _x( self::$singleName . ' Categories', 'Taxonomy General Name', 'text_domain' ),
                'singular_name'              => _x( self::$singleName . ' Category', 'Taxonomy Singular Name', 'text_domain' ),
                'menu_name'                  => __( self::$singleName . ' Categories', 'text_domain' ),
                'all_items'                  => __( self::$singleName . ' Categories', 'text_domain' ),
                'parent_item'                => __( 'Parent ' . self::$singleName . ' Category', 'text_domain' ),
                'parent_item_colon'          => __( 'Parent ' . self::$singleName . ' Category:', 'text_domain' ),
                'new_item_name'              => __( 'New ' . self::$singleName . ' Category', 'text_domain' ),
                'add_new_item'               => __( 'Add New ' . self::$singleName . ' Category', 'text_domain' ),
                'edit_item'                  => __( 'Edit ' . self::$singleName . ' Category', 'text_domain' ),
                'update_item'                => __( 'Update ' . self::$singleName . ' Category', 'text_domain' ),
                'separate_items_with_commas' => __( 'Separate ' . self::$singleName . ' Categories with commas', 'text_domain' ),
                'search_items'               => __( 'Search ' . self::$singleName . ' Categories', 'text_domain' ),
                'add_or_remove_items'        => __( 'Add or remove ' . self::$singleName . ' Categories', 'text_domain' ),
                'choose_from_most_used'      => __( 'Choose from the most used ' . self::$singleName . ' Categories', 'text_domain' ),
            );
        
            $args = array(
                'labels'                     => $labels,
                'hierarchical'               => true,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'rewrite'                    => array('with_front'=> false, 'slug' => self::$taxSlug),
                'show_tagcloud'              => false,
            );
        
            register_taxonomy(self::$taxName, self::$postType, $args );
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

    TrueProduct::init();
