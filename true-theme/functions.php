<?php

require_once 'app/helpers.php';
require_once 'vendor/autoload.php';

if (!defined('THEME_NAME')) {
    define('THEME_NAME', 'TRUE');
}

/**
 * Load environment
 */
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

/**
 * Roots includes
 */
require_once locate_template('/app/roots/utils.php');           // Utility functions
require_once locate_template('/app/roots/init.php');            // Initial theme setup and constants
require_once locate_template('/app/roots/wrapper.php');         // Theme wrapper class
require_once locate_template('/app/roots/sidebar.php');         // Sidebar class
require_once locate_template('/app/roots/config.php');          // Configuration
require_once locate_template('/app/roots/titles.php');          // Page titles
require_once locate_template('/app/roots/cleanup.php');         // Cleanup
require_once locate_template('/app/roots/nav.php');             // Custom nav modifications
require_once locate_template('/app/roots/gallery.php');         // Custom [gallery] modifications
require_once locate_template('/app/roots/comments.php');        // Custom comments modifications
require_once locate_template('/app/roots/relative-urls.php');   // Root relative URLs
require_once locate_template('/app/roots/widgets.php');         // Sidebars and widgets
require_once locate_template('/app/roots/scripts.php');         // Scripts and stylesheets
require_once locate_template('/app/roots/custom.php');          // Custom functions

require_once 'app/core.php';

function coreplus_custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'coreplus_custom_excerpt_length', 999 );

function prefix_wcount(){
    ob_start();
    the_content();
    $content = ob_get_clean();
    return sizeof(explode(" ", $content));
}

function change_wp_search_size($query) {
    if ( $query->is_search ) // Make sure it is a search page
        $query->query_vars['posts_per_page'] = -1; // number of posts you would like to show

    return $query; // Return our modified query variables
}
add_filter('pre_get_posts', 'change_wp_search_size'); // Hook our custom function onto the request filter

// add_filter( 'the_title', 'coreplus_blog_title_shortner' );

// function coreplus_blog_title_shortner( $title )
// {
//     // limit to 6 words
//     return wp_trim_words( $title, 6, '...' );
// }
// 

function limit_my_title($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function add_svg_to_upload_mimes($upload_mimes)
{
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter('upload_mimes', 'add_svg_to_upload_mimes', 10, 1);

function register_acf_windsor()
{
    \Windsor\Capsule\Manager::make()->register();
}
add_action('acf/init', 'register_acf_windsor');

function remove_block_css()
{
    wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'remove_block_css', 100);

add_action('wp_enqueue_scripts', 'enqueue_jquery_form');

function enqueue_jquery_form(){
	wp_enqueue_script('jquery-form');
}

add_action('wp_ajax_create_subscriber', 'create_subscriber');
add_action("wp_ajax_nopriv_create_subscriber", "create_subscriber");
function create_subscriber(){
	$email = $_POST['blog-subscriber-email'];
	$to = 'zaforiqbal13@gmail.com';
    $subject = 'coreplus new subscriber';
    $body = $email;
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);
	wp_send_json_success($email);
	
	wp_die();
}

add_action('wp_ajax_blog_feedback', 'blog_feedback');
add_action("wp_ajax_nopriv_blog_feedback", "blog_feedback");
function blog_feedback(){
	$feedback = $_POST['visitor-feedback'];
// 	$to = 'zaforiqbal13@gmail.com';
//     $subject = 'coreplus blog feedback';
//     $body = $feedback;
//     $headers = array('Content-Type: text/html; charset=UTF-8');
//     wp_mail($to, $subject, $body, $headers);
	wp_send_json_success($feedback);
	
	wp_die();
}



