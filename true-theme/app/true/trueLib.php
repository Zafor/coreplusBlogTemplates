<?php
    /* -------------------------------------------------- */
    /* TrueLib
    /* -------------------------------------------------- */
    /*
     * The holder of various functions that we use across our sites!
     */
    class TrueLib
    {

        public static function init()
        {
            add_filter('acf/format_value/type=wysiwyg', array(__CLASS__, 'formatWysiwygFieldValue'), 20, 3);

            add_action('wp_head', array(__CLASS__, 'addGoogleAnalytics'));
        }

        public static function formatWysiwygFieldValue( $value, $post_id, $field ) 
        {
            return '<div class="true-wysiwyg-field entry-content">' . $value . '</div>';
        }

        public static function getThemeUrl()
        {
            return get_template_directory_uri();
        }

        public static function getThemeDir($path = '')
        {
            return get_template_directory() . $path;
        }

        public static function getCSS($css)
        {
            return get_template_directory_uri() . '/assets/css/' . $css . '.css';
        }

        public static function getJS($js)
        {
            return get_template_directory_uri() . '/assets/js/' . $js . '.js';
        }

        public static function createSocialButton($title, $key, $image, $url, $suffix = '')
        {
            if(trim($url) != '')
            {
                ?>
                <li class="social-<?= $image ?>">
                    <a href="<?=$url?>" class="social-button <?=$image?>" target="_blank">
                        <img src="<?=self::getImageURL('social/social-' . $image . $suffix  . '.png')?>" alt="<?=$title?>" class="retina-image normal" />
                    </a>
                </li>
                <?php
            }

        }

        /**
         * [getTheExcerpt get the excerpt but limited to a specific number of characters
         * @param  integer $count [Number of characters to show]
         * @return [type]         [Trimmed string]
         */
        public static function getTheExcerpt($count = 100)
        {
            $permalink = get_permalink();
            $excerpt = strip_shortcodes(get_the_content());
            $excerpt = strip_tags($excerpt);
            $excerpt = substr($excerpt, 0, $count);
            $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
            $excerpt = $excerpt.'... <a href="'.$permalink.'">more</a>';
            return $excerpt;
        }

        /**
         * Print social links using font awesome
         * Need to make sure font awesome is included
         * @param  string $iconModifier [description]
         * @return [type]               [description]
         */
        public static function printSocialAwesome($iconModifier = '')
        {
            if(get_field('social_accounts', 'option'))
            {
                while(has_sub_field('social_accounts', 'option'))
                {  
                    $type = get_sub_field('account_type');
                    $url = get_sub_field('account_url');
                    $iconType = $type;
                    if ($type == 'youtube') {
                        $iconType = 'youtube-play';
                    }
                    if(trim($url) != '')
                    {
                        ?>
                        <li class="social-<?= $type ?>">
                            <a href="<?=$url?>" class="social-button <?=$type?>" target="_blank" title="<?= ucfirst($type) ?>">
                                <i class="fa fa-<?= $iconType ?> <?= $iconModifier ?>"></i>
                            </a>
                        </li>
                        <?php
                    }
                }
            }
        }

        public static function printSocialButtons($suffix = '')
        {
            if(get_field('social_accounts', 'option'))
            {
                while(has_sub_field('social_accounts', 'option'))
                {
                    TrueLib::createSocialButton(ucfirst(strtolower(get_sub_field('account_type'))), 'social-' . get_sub_field('account_type'), get_sub_field('account_type'), get_sub_field('account_url'), $suffix);
                }
            }
        }

        public static function getFooterCopyright()
        {
            if (function_exists('get_field')) {
                return str_replace('%year%', date('Y'), get_field('footer_copyright', 'option'));
            } else {
                return '';
            }
        }

        public static function getTemplatePart($name)
        {
            get_template_part('page-templates/v1-partials/' . $name);
        }


        /* -------------------------------------------------- */
        /* Get Image with ACF - DEPRECIATED
        /* -------------------------------------------------- */
        static function getACFImage($key, $imageSize = '', $subField = false, $ID = null, $class = '')
        {
            if($ID == null)
            {
                if($subField)
                {
                    $image = get_sub_field($key);   
                } else {
                    $image = get_field($key);  
                }
            } else {
                if($subField)
                {
                    $image = get_sub_field($key, $ID);   
                } else {
                    
                    $image = get_field($key, $ID);
                } 
            }

            //If we have an image, display it!
            if($image)
            {
                if($imageSize != '')
                {
                    $imageURL = $image['sizes'][$imageSize];
                } else {
                    $imageURL = $image['url'];
                }
                
                $str = '<img ';
                if($class != '')
                {
                    $str .= 'class="' . $class . '"';
                }
                
                return $str . ' src="' . $imageURL . '" alt="' . $image['alt'] . '">'; 
            }
            return '';
        }

        //  - DEPRECIATED
        static function createImageTag($url, $alt = '', $class = '', $retina = false)
        {
            if($retina)
            {
                $class .= ' retina-image';
            }
            
            $str = '<img ';
            if($class != '')
            {
                $str .= 'class="' . trim($class) . '"';
              
            }
            return  $str . ' src="' . self::getImageURL($url) . '" alt="' . $alt  . '">';
        }

        /* Get Image with ACF
        /* name = acf key / filename
        /* class = string
        /*
        /* ACF Specific:
        /* id = integer
        /* acf = true / false
        /* size = string
        /* subfield = true / false

        /* Standard Image:
        /* retina = true / false - not applicable to acf

        /* -------------------------------------------------- */
        public static function getImage($args)
        {
            $name = $size = $alt = $class = '';
            $acf = true;
            $retina = false;
            $subfield = false;
            $id = get_the_ID();
            extract($args);

            if($acf)
            {
                if($subfield)
                {
                    $image = get_sub_field($name);
                } else {

                  $image = get_field($name, $id);
                }

                  //If we have an image, display it!
                if($image)
                {
                    if($size != '')
                    {
                        $imageURL = $image['sizes'][$size];
                    } else {
                        $imageURL = $image['url'];
                    }

                    $str = '<img ';
                    if($class != '')
                    {
                        $str .= 'class="' . $class . '"';
                    }

                    return $str . ' src="' . $imageURL . '" alt="' . $image['alt'] . '">';
                }
              } else {
                  if($retina)
                  {
                      $class .= ' retina-image';
                  }

                  $str = '<img ';
                  if($class != '')
                  {
                      $str .= 'class="' . trim($class) . '"';

                  }
                  return  $str . ' src="' . self::getImageUrl($url) . '" alt="' . $alt  . '">';
              }
              return '';
          }


        /* Get Image with ACF
        /* Args, an array for acf images, or string for a standard image from assets
        /*
        /* name = acf key / filename
        /* subfield = true / false
        /* id = postid
        /* acf = true / false
        /* size = string
        /* ---------------------------------------*/
        public static function getImageUrl($args)
        {
            if(is_array($args))
            {
                $name = $size = $alt = $class = '';
                $subfield = false;
                $id = get_the_ID();
                extract($args);
                if($subfield)
                {
                    $image = get_sub_field($name);
                } else {

                    $image = get_field($name, $id);
                }


                if($image)
                {
                    if($size != '')
                    {
                        $imageURL = $image['sizes'][$size];
                    } else {
                        $imageURL = $image['url'];
                    }

                    return $imageURL;
                }
            } else {
                return get_template_directory_uri() . '/assets/img/' . $args;
            }

            return '';
        }

        public static function getChildPages($post_id)
        {
            $pages_children = get_pages('child_of='.$post_id.'&hierarchical=0&parent='.$post_id.'&sort_column=menu_order');
            return $pages_children;
        }

        /**
         * Debug utilities
         */

        public static function printVar($var)
        {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }

        /**
         * To use this, add hook somewhere in theme.php file
         * add_action('admin_init', array('TrueLib', 'showMenuStructure'));
         * 
         */
        public static function showMenuStructure()
        {
            echo '<pre>'.print_r($GLOBALS['menu'], true).'</pre>';
        }

        /**
         * Add the Google Analytics Code to the Header
         */
        public static function addGoogleAnalytics()
        {
            if (Config::isLocal()) {
                return;
            }

            $trackingID = trim(get_field("google_analytics_id", 'option'));
            if (empty($trackingID)) {
                return;
            }
              
            ?>
            <script>
             (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
             (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
             m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
             })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

             ga('create', '<?=$trackingID?>', 'auto');
             ga('send', 'pageview');

            </script>
            <?php
        }

        /**
         * Array Get
         */
        public static function arrayGet($array, $key, $default = null)
        {
            if (is_null($key)) return $array;

            if (isset($array[$key])) return $array[$key];

            foreach (explode('.', $key) as $segment)
            {
                if ( ! is_array($array) || ! array_key_exists($segment, $array))
                {
                    return value($default);
                }

                $array = $array[$segment];
            }

            return $array;
        }
    }

    TrueLib::init();