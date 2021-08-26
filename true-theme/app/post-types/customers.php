<?php
function trueCreateCustomerPostType() {
	register_post_type( 'customer',
		array(
			'labels' => array(
				'name' => __( 'Customers' ),
				'singular_name' => __( 'Customer' ),
				'add_new_item' => __( 'Add New Customer' ),
				'edit_item' => __( 'Edit Customer' ),
				'new_item' => __( 'New Customer' ),
				'view_item' => __( 'View Customer' ),
				'search_items' => __( 'Search Customers' ),
				'not_found' => __( 'Customers Not Found' )
			),
		'public' => false,
		'has_archive' => true,
		'show_ui' => true,
        'menu_position' => 5,
        'capability_type'     => 'page',
		'menu_icon' => TrueLib::getImageURL('true-icons/trueClientWPIcons.png'),
		)
	);
}
add_action( 'init', 'trueCreateCustomerPostType' );

function includeCustomerTemplate( $template_path ) 
{
            
    if ( get_post_type() == 'customer') 
    {
        if ( is_single() ) 
        {
            if ( $theme_file = locate_template( array ( 'page-templates/single-customer.php' ) ) ) 
            {
            	$template_path = $theme_file;
            }
        }
    }
    return $template_path;
}
add_filter( 'template_include', 'includeCustomerTemplate', 1 );

class TrueCustomer 
{
	static function getCustomersByProfession($professionID)
	{
		$args = array(
			'post_type' => 'customer',
			'orderby' => 'rand',
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => TrueAddon::$taxName,
					'field'    => 'id',
					'terms'    => $professionID,
					'include_children' => false
				),
			)
		);
		$posts = get_posts($args);

		return $posts;
	}
}