<?php    
    
    class HomeContent
    {
        private static $baseID = 9810;

        private static $currentProfession = null;

        /* -------------------------------------------------- */
        /* Edit these variables
        /* -------------------------------------------------- */
        private static $postType = 'cpt_home_content';
        private static $singleName = 'Home Content';
        private static $pluralName = 'Home Contents';
        private static $slug = 'healthcare-type';
        private static $templateName = 'page-home';
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
            
            // Admin footer
            add_action( 'current_screen', array(__CLASS__, 'isEditPage') );

            self::loadCurrentProfession();

            add_action( 'wp_ajax_set_profession', array(__CLASS__, 'setProfession') );
            add_action( 'wp_ajax_nopriv_set_profession', array(__CLASS__, 'setProfession') );
            
            add_action('template_redirect', [__CLASS__, 'redirectHomeToProfession']);
        }
        
        /**
         * Redirect the homepage to profession?
         *
         * @return void
         */
        public static function redirectHomeToProfession()
        {
            $currentProfession = self::getPreferredProfession();
            if($currentProfession == 0) {
                return;
            }
            
            if( is_page( 'home' ))
            {
                wp_redirect( get_the_permalink($currentProfession) );
                die;
            }
        }

        public static function loadCurrentProfession()
        {
            global $post;
                        
            if(isset($_COOKIE['current_profession'])) {
                self::$currentProfession = $_COOKIE['current_profession'];
            }
        }

        public static function getPreferredProfession()
        {
            $post = get_post(self::$currentProfession);

            if($post && $post->post_type != self::$postType) {
                return 0;
            }

            return $post->ID;
        }

        /**
         * Is Default
         *
         * @return boolean
         */
        public static function isDefault()
        {
            return (self::$currentProfession == self::$baseID);
        }

        public static function getHeaderLabel()
        {
            if(self::isDefault()) {
                return '';
            }

            $title = get_field('profession_picker_title', self::$currentProfession);
            $start = "I'm a";

            if(trim(strtoupper($title)) == 'OTHER HEALTHCARE') {
                $start .= 'n';
            }

            return $start . " <span class='shortcode-underline'>" . ucfirst($title) . '</span> provider';
            
        }

        public static function getSectionSource($source)
        {
            global $post;
            if(get_field('use_base_' . $source, self::$currentProfession)) {
                return self::$baseID;    
            }
            
            if(is_front_page()) {
                return self::$baseID;
            }

            return $post->ID;
        }

        public static function setProfession()
        {
            setcookie('current_profession', (int)$_POST['profession'], time() + (86400 * 180), "/"); // 86400 = 1 day
            wp_send_json([
                'status' => 'SUCCESS'
            ]);
            die;
        }

        /**
         * Get the list of professions users in the post type
         *
         */
        public static function getProfessionList()
        {
            $args = array(  'post_type' => self::$postType,
                            'numberposts' => -1,
                            'post_status' => 'publish',
                            'orderby' => 'meta_value_num',
                            'meta_key' => 'sort_order',
                            'order' => 'ASC',
                        );
    
            $allPosts = get_posts($args);


            $posts = [];
            foreach($allPosts as $post) {
                if($post->ID == self::$baseID) {
                    continue;
                }

                $posts[$post->ID] = get_field('profession_picker_title', $post->ID);
            }

            return $posts;
        }

        public static function isEditPage()
        {
            $screen = get_current_screen();

            if($screen->id == 'cpt_home_content') {
                global $post;
                
                if($_REQUEST['post'] == self::$baseID) {
                    add_filter('admin_footer_text', function()
                    {
                        ?>
                        <style>
                            .home-content-inherit-content-field { display: none !important; }
                        </style>
                        <?php
                    });
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
                'menu_icon' => 'dashicons-screenoptions',
                'supports' => array('title'),
                'exclude_from_search' => false,
                'has_archive'         => false,
                'capability_type'     => 'page'
            );
                
                
            
            $args['rewrite'] = array('slug' => self::$slug, 'with_front' => true);
            
            register_post_type( self::$postType, $args);

            // Add the professions Taxonomy

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

    HomeContent::init();
