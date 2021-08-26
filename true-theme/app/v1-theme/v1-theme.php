<?php

define('BLOG_POST_ID', 688);
define('FEATURES_PAGE_ID', 636);
define('PRICING_PAGE_ID', 717);
define('PRICING_SIMPLIFIED_PAGE_ID', 5422);
define('TRIAL_PAGE_ID', 3725);
define('PROFESSIONS_PAGE_ID', 4901);
define('ADDONS_PAGE', 763);

require "coreplus-trial.php";

function searchfilter($query) 
{
    if ($query->is_search && !is_admin() ) 
    {
        $query->set('post_type',array('post'));
    }

    return $query;
}

add_filter('pre_get_posts','searchfilter');


function trueRegisterMenus() {
    register_nav_menus(
        array(
            'footer-primary' => __( 'Footer Primary' ),
            'footer-secondary' => __( 'Footer Secondary' )
        )
    );
}
add_action( 'init', 'trueRegisterMenus' );
    

function createTrueBreadcrumb($title = '', $postID = null)
{
    $object = get_queried_object();
    $title = '';
    $pageURL = '';
    $parent = '';
    if($object != null)
    {
        if(get_class($object) == 'WP_Post')
        {
            if($title == '')
            {
                $title = get_the_title($postID);
            }
            
            $pageURL = get_permalink($postID);
        } else if(isset($object->term_id)) { //Term
            if($object->parent != 0)
            {
                //display the parent as well
                $parent = get_term($object->parent, $object->taxonomy);
                $termURL = get_term_link($parent);
                $termTitle = $parent->name;
                $parent = '&gt; ' . $termTitle;
            }
            $title = $object->name;
            $pageURL = get_term_link($object);
        }
    } else { // Archives
         $title = get_the_title($postID);
         $pageURL = get_permalink($postID);
    }
    ?>
    <div class="breadcrumbs">
        <span><a href="<?php echo site_url()?>">home</a> <?=$parent?> &gt; <a href="<?php echo $pageURL?>"><?php echo $title?></a></span>
    </div>
    <?php
    
}


function twentytwelve_body_class( $classes ) 
{
    if(!in_array('post-type-archive-product', $classes) && !is_home())
    {
        
        if(is_tax(TrueAddon::$taxName))
        {
            $classes[] = 'full-width';
            $classes[] = 'profession';
        } else {
            if(is_page('blog') || in_array('single-post', $classes) || in_array('search', $classes) || in_array('archive', $classes))
            {
                $classes[] = 'blog';
            } else {
                $classes[] = 'full-width';
            }
        }
    }
    
    if(is_page('features') || is_singular('true_feature'))
    {
        $classes[] = 'features';
    }
    
    if(is_page('customers'))
    {
        $classes[] = 'customers';
    }
    
    if(is_page('about-us'))
    {
        $classes[] = 'about';
    }
    
    if(is_page('partners'))
    {
        $classes[] = 'partners';
    }
    
    if(is_page('contact'))
    {
        $classes[] = 'contact-page';
    }

    if(is_page('e-health-tele-health'))
    {
        $classes[] = 'ehealth';
    }
    
    if(is_page(717) || is_page(PRICING_SIMPLIFIED_PAGE_ID)) $classes[] = 'pricing';
    if(is_page(757)) $classes[] = 'referrer-network';
    if(is_page(807)) $classes[] = 'cash-flow';
    if(is_page(755)) $classes[] = 'practice-management';
    if(is_page(763)) $classes[] = 'online-addons';
    if(is_page(759)) $classes[] = 'training';
    if(is_page(3725)) $classes[] = 'trial';
                                                       
    return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class', 999 );

function banner_shortcode( $atts, $content = null ) 
{
    return '<span>' . $content . '</span>';
}
add_shortcode( 'happy', 'banner_shortcode' );    

function abbr_shortcode( $atts, $content = null ) 
{
    return '<span class="abbr">' . $content . '</span>';
}
add_shortcode( 'abbr', 'abbr_shortcode' );    
    
        
    function change_default_title( $title )
    {
        $screen = get_current_screen();
        
        switch($screen->post_type)
        {
            
        }
         
        return $title;
    }
     
    add_filter( 'enter_title_here', 'change_default_title' );
    
    function new_excerpt_more( $more ) {
        return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More</a>';
    }
    add_filter('excerpt_more', 'new_excerpt_more');


    function trueCreateSidebars() {
        register_sidebar( array(
            'name' => __( 'Main Sidebar', 'twentytwelve' ),
            'id' => 'sidebar-main',
            'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        
    }
    add_action( 'widgets_init', 'trueCreateSidebars' );



    if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
    /**
     * Displays navigation to next/previous pages when applicable.
     *
     * @since Twenty Twelve 1.0
     */
        function twentytwelve_content_nav( $html_id ) {
            global $wp_query;
        
            $html_id = esc_attr( $html_id );
        
            if ( $wp_query->max_num_pages > 1 ) : ?>
                <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
                    <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
                    <div class="nav-previous alignleft"><?php next_posts_link( __( 'Older posts &gt;', 'twentytwelve' ) ); ?></div>
                    <div class="nav-next alignright"><?php previous_posts_link( __( '&lt; Newer posts', 'twentytwelve' ) ); ?></div>
                </nav><!-- #<?php echo $html_id; ?> .navigation -->
            <?php endif;
        }
    endif;
    
    function trueSinglePostNav()
    {
        ?>
        <nav class="nav-single">
            <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
            <span class="nav-previous"><?php previous_post_link( '%link', '%title &gt;' ); ?></span>
            <span class="nav-next"><?php next_post_link( '%link', '&lt; %title'); ?></span>
        </nav><!-- .nav-single -->
        <?php
    }         
    
    if ( function_exists( 'wpcf7_ajax_loader' ) ) 
    {
         add_filter( 'wpcf7_ajax_loader', 'wap8_wpcf7_ajax_loader' );
         
         function wap8_wpcf7_ajax_loader($url) 
         {
             return TrueLib::getImageURL('../img/ajax-loader.gif');
         }  
    }
    
    function embed_output_filter( $html, $url, $attr ) 
    {
        // Only run this process for embeds that don't required fixed dimensions
        $resize = false;
        $accepted_providers = array(
            'youtube',
            'vimeo',
            'slideshare',
            'dailymotion',
            'viddler.com',
            'hulu.com',
            'blip.tv',
            'revision3.com',
            'funnyordie.com',
            'wordpress.tv',
            'scribd.com',
        );

        // Check each provider
        foreach ( $accepted_providers as $provider ) 
        {
            if ( strstr( $url, $provider ) ) {
                $resize = true;
                break;
            }
        }

        // Cleanup output to avoid wpautop() conflicts
        $embed = preg_replace( '/\s+/', '', $html ); // Clean-up whitespace
        $embed = trim( $embed );
        global $content_width;

        $html = '<div class="video-container" data-content-width="' . $content_width . '">' . $html . '</div>';

        return $html;
    }
    
    add_filter( 'embed_oembed_html', 'embed_output_filter', 1, 3 );
     
