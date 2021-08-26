<?php    
    
    class TruePricing
    {
        /* -------------------------------------------------- */
        /* Edit these variables
        /* -------------------------------------------------- */
        private static $ref = 'TruePricing'; //Name of the post type, needed for callbacks
        private static $postType = 'true_pricing';
        private static $singleName = 'Pricing';
        private static $pluralName = 'Pricing Plans';
        private static $slug = '';
        private static $templateName = 'page-features';
        private static $menuImage = 'truePricingWPIcons';

        static function getPlans()
        {
            return self::getAll();
        }
        
        static function calculatePricing()
        {
            $response['status'] = 'error';
            if(!isset($_POST['parttime']) || !isset($_POST['fulltime']) || !isset($_POST['subscription']))
            {
                $response['type'] = 'missingfields';
                echo json_encode($response);
                die;
            }
            
            if(!is_numeric($_POST['parttime']) || !is_numeric($_POST['fulltime']) || !is_numeric($_POST['subscription']))
            {
                $response['type'] = 'not numeric';
                echo json_encode($response);
                die;
            }
            
            $partTimeUsers = (int)$_POST['parttime'];
            $fullTimeUsers = (int)$_POST['fulltime'];
            $subscription = (int)$_POST['subscription'];
            
            if($partTimeUsers <= 0 && $fullTimeUsers <= 0)
            {
                echo json_encode($response);
                die;
            }
            
            //Assemble our pricing variables
            $partTimeUserCost = (float)get_field('part_time_user_price', PRICING_PAGE_ID);
            
            $foundSubscription = false;
            $value1 = 0;
            $value2 = 0;
            $value3 = 0;
            $value4 = 0;
            $discount = 0;
            
            //Get the subscription plan they selected
            if(get_field('subscriptions', PRICING_PAGE_ID))
            {
                while(has_sub_field('subscriptions', PRICING_PAGE_ID))
                {
                    if($subscription == get_sub_field('subid'))
                    {
                        $foundSubscription = true;
                        $value1 = (float)get_sub_field('value_1');
                        $value2 = (float)get_sub_field('value_2');
                        $value3 = (float)get_sub_field('value_3');
                        $value4 = (float)get_sub_field('value_4');
                        $discount = (float)get_sub_field('discount');
                    }
                }
            }
            
            if($foundSubscription)
            {
                $cost = self::calculatePricingPlan($partTimeUsers, $fullTimeUsers, $partTimeUserCost, $value1, $value2, $value3, $value4, $discount, $subscription);
                
                //Send back the right plan ID
                $planID = -1;
                $response['multi'] = false;
                $totalUsers = $fullTimeUsers + $partTimeUsers;
                if($fullTimeUsers > 1 || $partTimeUsers > 1 || $totalUsers > 1)
                {
                    $planID = 913;
                    $response['multi'] = true;
                } else {
                    if($fullTimeUsers == 0)
                    {
                        $planID = 915;
                    } else if($partTimeUsers == 0) 
                    {
                        $planID = 916;
                    }
                }
                
                $response['status'] = 'success';
                $response['price'] = '$' . number_format(($cost), 2);
                $response['plan-id'] = $planID;
                echo json_encode($response);
                
                die;
            } else {
                echo json_encode($response);
                die;
            }
        }
        
        /* Performs the actual calculations
        /* -------------------------------------------------- */
        private static function calculatePricingPlan($partTimeUsers, $fullTimeUsers, $partTimeUserCost, $value1, $value2, $value3, $value4, $discount, $subscription)
        {
            //Do the part time only calculation
            if($fullTimeUsers == 0)
            {
                return $partTimeUsers * $partTimeUserCost;
            } else {
                $cost = 0;
                //Normal formula!
                
                $users = $fullTimeUsers;
                

                // Pricing Matrix
                $pricingMatrix = array(
                        array( 65.00,      65.00,       58.50,      55.25 ),
                        array( 50.00,     100.00,       90.00,      85.00 ),
                        array( 50.00,     150.00,      135.00,     127.50 ),
                        array( 50.00,     200.00,      180.00,     170.00 )
                    );
                $userPriceIndex = $users-1;
                if (isset($pricingMatrix[$userPriceIndex][$subscription])) {
                    $cost += $pricingMatrix[$userPriceIndex][$subscription];
                }
                else {
                    throw new Exception("Error calculating price", 1);
                }

                
                // $cost = $users * (($value1 - (($users - $value2) * $value3)) * $value4);
                //Apply the discount, if this subscription has one
                // if($discount > 0)
                // {
                //     $cost -= $cost * $discount / 100;
                // }  

                $cost += $partTimeUsers * $partTimeUserCost;
                return $cost;
            }
            
        }
        
        
        /* -------------------------------------------------- */
        /* Add all Wordpress hooks here
        /* -------------------------------------------------- */
        static function init()
        {
            add_action('init', array(self::$ref, 'createPostType'));
            
            add_action( 'wp_ajax_calculate_pricing', array(self::$ref, 'calculatePricing') );
            add_action( 'wp_ajax_nopriv_calculate_pricing', array(self::$ref, 'calculatePricing') );
            
            if(trim(self::$slug) != '')
            {
                add_filter( 'template_include', array(self::$ref, 'includeTemplate'), 1 );
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
                            'numberposts' => 3,
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
                'public' => false,
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

    TruePricing::init();
