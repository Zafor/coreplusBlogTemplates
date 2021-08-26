<?php
    /* -------------------------------------------------- */
    /* TrueShare
    /* -------------------------------------------------- */
    /*
     * Customisable sharer, using addthis library and 
     * our True Agency Options Social Icon class
     *
     * @usage TrueShare::render()
     *
     */
    class TrueShare
    {

        /**
         * These are icon image configuration around sharing feature
         * Best to follow pre-defined structure.
         * @var array
         */
        private static $icons = array(
                'facebook' => 'social-share/facebook.png',
                'twitter' =>  'social-share/twitter.png',
                'linkedin' => 'social-share/linkedin.png',
                'email' => 'social-share/email.png',
                'googleplus' => 'social-share/googleplus.png'
            );

        /**
         * Path to be supplied to View::make
         * which renders social share template
         * @var string
         */
        public static $view = 'social-share';

        /**
         * Ensure script loaded only once
         * @var boolean
         */
        private static $scriptLoaded = false;

        public static function getShareSettings()
        {
            $settings = array();

            $customURL = ''; $customTitle = '';
            $iconlist = new TrueSocialicons();
            $services = $iconlist->getSupportedServices();
            $enabledServices = $iconlist->getEnabledServices();
            $size = 'small';
            
            $attributes = '';
            if($customURL != '')
            {
                $attributes = 'addthis:url="' . $customURL . '" ';
                $attributes .= ' addthis:counturl="' . $customURL . '" ';
            }
            
            if($customTitle != '')
            {
                $attributes .= 'addthis:title="' . $customTitle .'"';
            }

            $sizeCode = ' addthis_16x16_style';
            if($size == 'medium')
            {
                $sizeCode = '';
            }

            $settings = compact('sizeCode', 'attributes');

            $settings['services'] = array();

            foreach($enabledServices as $serviceKey => $service)
            {
                $serviceDetails = $services[$service['name']];

                if (isset(self::$icons[$serviceKey])) {
                    $iconImage = '<img src="'.TrueLib::getImageUrl(self::$icons[$serviceKey].'" alt="'.$service['name']).'" class="retina-image">';
                    $icon = str_replace('{icon}', $iconImage, $serviceDetails['code-' . $size]);
                } else {
                    // Fallback to our plugin setting
                    $icon = str_replace('{icon}','',$serviceDetails['code-' . $size]);
                }

                if($serviceDetails['name'] == 'Twitter' && $customURL != '')
                {
                    $settings['services'][] = str_replace('{count_url}', $customURL, $icon);
                    
                } else {
                    if($serviceDetails['name'] == 'Twitter')
                    {
                        $settings['services'][] = str_replace('data-counturl="{count_url}"', '', $icon);  
                    } else {
                        $settings['services'][] = $icon;
                    }
                }
            }

            return $settings;
        }

        public static function loadScript() {
            if (self::$scriptLoaded) {
                return;
            }
            self::$scriptLoaded = true;
            ?>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script>
            <!-- AddThis Button END -->
            <?php
        }
        
        public static function render()
        {
            View::render(self::$view);
            self::loadScript();
        }
    }