<?php

/*
* Template Name: Coreplus Blogs
*/

//get_header();
?>


<div class="sub-menu-section">
    <div class="sub-menu blog-width">
        <div class="blog-nav row">
            <div class="blog-nav-items col-lg-8 col-md-12 col-sm-12">
                <a href="https://qa-web.coreplus.com.au/blogs/" class="blog-submenu-links active-navbar">All</a>
                <a href="https://qa-web.coreplus.com.au/digital-health/" class="blog-submenu-links">Digital Health</a>
                <a href="https://qa-web.coreplus.com.au/add-ons-page/" class="blog-submenu-links">Add-ons</a>
                <a href="https://qa-web.coreplus.com.au/covid-page/" class="blog-submenu-links">COVID-19</a>
                <a href="https://qa-web.coreplus.com.au/health-practitioners-page/" class="blog-submenu-links">Health Practitioners</a>
                <a href="https://qa-web.coreplus.com.au/new-feature-page/" class="blog-submenu-links">New Feature</a>
            </div>
            <div class="blog-nav-search col-lg-4 col-md-12 col-sm-12">
                <input type="search" class="blog-search-input" placeholder="Blog Search "> <button type="submit" class="blog-search"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="featured">
        <div class="featured-heading blog-width row featured-heading-spacing">
            <div class="featured-title col-sm-12">
                <p class="text-sm-center">Featured Stories</p>
            </div>
            <div class="featured-brief col-sm-12">
                <p><?php the_field('featured_detail'); ?></p>
            </div>
        </div>
    </div>

    <div class="featured-blogs blog-width row">
		<?php 
	$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'featured',
    'posts_per_page' => 2,
);
$arr_posts = new WP_Query( $args );
 
if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
        <div class="featured-blog col-lg-6 col-md-6 col-sm-12">
		<div class="post-image">
        <img title="image title" alt="thumb image" class="wp-post-image" 
             src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;">
    	</div>
            <p class="blog-category">
               <?php echo 'Featured'?>
				
            </p>
            <p class="blog-title">
                <a class="blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </p>
            <p class="blogging-info">
				
                <span class="blogger-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
				</span>			
                <span> By <?php the_author(); ?>  | <?php the_time('F j, Y'); ?> </span>
            </p>
        </div>
		     <?php
    endwhile;
endif;
	wp_reset_postdata();
	?>
    </div> 
</div>

<div class="section blog-width">
    <div class="featured">
        <div class="featured-heading row featured-heading-spacing">
            <div class="featured-title col col-sm-12">
                <p class="text-sm-center">Digital Health</p>
            </div>
            <div class="featured-brief col col-sm-12">
                <p>Viverra adipiscing sapien facilisis pharetra viverra. Eros tristique arcu, convallis aliquet quisque ut sit nisl. Senectus sapien quis et, sollicitudin. Egestas venenatis molestie tincidunt bibendum ultrices laoreet arcu.</p>
            </div>
        </div>
    </div>
    <div class="blog-width">
        <hr>
    </div>
    <div class="section-blogs blog-width row">
		<?php 
	$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'digital-health',
    'posts_per_page' => 3,
);
$arr_posts = new WP_Query( $args );
 
if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
		<div class="section-blog col-lg-4 col-md-6 col-sm-12">
		<div class="post-image">
        <img title="image title" alt="thumb image" class="wp-post-image" 
             src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;">
    	</div>
            <p class="blog-category">
               <?php echo 'DIGITAL HEALTH'?>
				
            </p>
            <p class="section-blog-title">
                <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </p>
            <p class="blogging-info">
				
                <span class="blogger-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
				</span>			
                <span> By <?php the_author(); ?>  | <?php the_time('F j, Y'); ?> </span>
            </p>
        </div>
		
		     <?php
    endwhile;
endif;
	wp_reset_postdata();
	?>
    </div>
    <div class="s-button-div">
        <a href="" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Digital Health <i class="fas fa-arrow-right"></i> &nbsp;&nbsp;&nbsp;</a>
    </div>
</div>

<!-- flex-sm-row-reverse bs class for reversing row elements -->

<div class="cta-section">
    <div class="cta-section-content blog-width row flex-column-reverse flex-lg-row flex-md-row">
        <div class="cta-button col-lg-6 col-md-6 col-sm-12 ">
            <p>Enable Secure Health Provider Directory and Messaging</p>
            <a href="" class="btn section-button-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;See How&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 cta-image">
            <img src="<?php the_field('ct_section_enable_secure_health') ?>" alt="">
        </div>
    </div>
</div>

<div class="section blog-width">

    <div class="featured">
        <div class="featured-heading row featured-heading-spacing">
            <div class="featured-title col col-sm-12">
                <p class="text-sm-center">Add-ons</p>
            </div>
            <div class="featured-brief col col-sm-12">
                <p>Viverra adipiscing sapien facilisis pharetra viverra. Eros tristique arcu, convallis aliquet quisque ut sit nisl. Senectus sapien quis et, sollicitudin. Egestas venenatis molestie tincidunt bibendum ultrices laoreet arcu.</p>
            </div>
        </div>
    </div>

    <div class="blog-width">
        <hr>
    </div>

    <div class="section-blogs blog-width row">
		<?php 
	$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'online-add-ons-2',
    'posts_per_page' => 3,
);
$arr_posts = new WP_Query( $args );
 
if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
		<div class="section-blog col-lg-4 col-md-6 col-sm-12">
		<div class="post-image">
        <img title="image title" alt="thumb image" class="wp-post-image" 
             src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;">
    	</div>
            <p class="blog-category">
               <?php echo 'Add-ons'?>
				
            </p>
            <p class="section-blog-title">
                <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </p>
            <p class="blogging-info">
				
                <span class="blogger-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
				</span>			
                <span> By <?php the_author(); ?>  | <?php the_time('F j, Y'); ?> </span>
            </p>
        </div>
		
		     <?php
    endwhile;
endif;
	wp_reset_postdata();
	?>
    </div>
    <div class="s-button-div">
        <a href="" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Add-ons <i class="fas fa-arrow-right"></i> &nbsp;&nbsp;&nbsp;</a>
    </div>
</div>

<div class="section blog-width">

    <div class="featured">
        <div class="featured-heading row featured-heading-spacing">
            <div class="featured-title col col-sm-12">
                <p class="text-sm-center">COVID-19</p>
            </div>
            <div class="featured-brief col col-sm-12">
                <p>Viverra adipiscing sapien facilisis pharetra viverra. Eros tristique arcu, convallis aliquet quisque ut sit nisl. Senectus sapien quis et, sollicitudin. Egestas venenatis molestie tincidunt bibendum ultrices laoreet arcu.</p>
            </div>
        </div>
    </div>

    <div class="blog-width">
        <hr>
    </div>

    <div class="section-blogs blog-width row">
		<?php 
	$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'covid-19',
    'posts_per_page' => 3,
);
$arr_posts = new WP_Query( $args );
 
if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
		<div class="section-blog col-lg-4 col-md-6 col-sm-12">
		<div class="post-image">
        <img title="image title" alt="thumb image" class="wp-post-image" 
             src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;">
    	</div>
            <p class="blog-category">
               <?php echo 'COVID-19'?>
				
            </p>
            <p class="section-blog-title">
                <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </p>
            <p class="blogging-info">
				
                <span class="blogger-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
				</span>			
                <span> By <?php the_author(); ?>  | <?php the_time('F j, Y'); ?> </span>
            </p>
        </div>
		
		     <?php
    endwhile;
endif;
	wp_reset_postdata();
	?>
    </div>

    <div class="s-button-div">
        <a href="" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Advisers <i class="fas fa-arrow-right"></i> &nbsp;&nbsp;&nbsp;</a>
    </div>
</div>

<div class="cta-section">
    <div class="cta-section-content blog-width  row flex-column-reverse flex-lg-row flex-md-row">
        <div class="cta-button col-md-6">
            <p>Don’t Want to Miss Coreplus Stories & Updates!</p>
            <input type="text" class="btn blog-subscriber-email no-wrap" placeholder="Enter your Email Address">
            <a href="" class="btn section-button-white">&nbsp;&nbsp;&nbsp;&nbsp;Subscribe&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
        <div class="col-md-6 cta-image">
            <img src="<?php the_field('subscribe_to_blogs') ?>" alt="">
        </div>
    </div>
</div>

<div class="section blog-width">

    <div class="featured">
        <div class="featured-heading row featured-heading-spacing">
            <div class="featured-title col col-sm-12">
                <p class="text-sm-center">Health Practitioners</p>
            </div>
            <div class="featured-brief col col-sm-12">
                <p>Viverra adipiscing sapien facilisis pharetra viverra. Eros tristique arcu, convallis aliquet quisque ut sit nisl. Senectus sapien quis et, sollicitudin. Egestas venenatis molestie tincidunt bibendum ultrices laoreet arcu.</p>
            </div>
        </div>
    </div>

    <div class="blog-width">
        <hr>
    </div>

    <div class="section-blogs blog-width row">
		<?php 
	$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'health-practitioners',
    'posts_per_page' => 3,
);
$arr_posts = new WP_Query( $args );
 
if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
		<div class="section-blog col-lg-4 col-md-6 col-sm-12">
		<div class="post-image">
        <img title="image title" alt="thumb image" class="wp-post-image" 
             src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;">
    	</div>
            <p class="blog-category">
               <?php echo 'Health Practitioners'?>
				
            </p>
            <p class="section-blog-title">
                <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </p>
            <p class="blogging-info">
				
                <span class="blogger-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
				</span>			
                <span> By <?php the_author(); ?>  | <?php the_time('F j, Y'); ?> </span>
            </p>
        </div>
		
		     <?php
    endwhile;
endif;
	wp_reset_postdata();
	?>
    </div>
    <div class="s-button-div">
        <a href="" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Practice Life <i class="fas fa-arrow-right"></i> &nbsp;&nbsp;&nbsp;</a>
    </div>
</div>


<div class="section blog-width">
    <div class="featured">
        <div class="featured-heading row featured-heading-spacing">
            <div class="featured-title col col-sm-12">
                <p class="text-sm-center">New Feature</p>
            </div>
            <div class="featured-brief col col-sm-12">
                <p>Viverra adipiscing sapien facilisis pharetra viverra. Eros tristique arcu, convallis aliquet quisque ut sit nisl. Senectus sapien quis et, sollicitudin. Egestas venenatis molestie tincidunt bibendum ultrices laoreet arcu.</p>
            </div>
        </div>
    </div>

    <div class="blog-width">
        <hr>
    </div>

    <div class="section-blogs blog-width row">
		<?php 
	$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => 'new-feature',
    'posts_per_page' => 3,
);
$arr_posts = new WP_Query( $args );
 
if ( $arr_posts->have_posts() ) :
 
    while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
		<div class="section-blog col-lg-4 col-md-6 col-sm-12">
		<div class="post-image">
        <img title="image title" alt="thumb image" class="wp-post-image" 
             src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" style="width:100%; height:auto;">
    	</div>
            <p class="blog-category">
               <?php echo 'New Feature'?>
				
            </p>
            <p class="section-blog-title">
                <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </p>
            <p class="blogging-info">
				
                <span class="blogger-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 42 ); ?>
				</span>			
                <span> By <?php the_author(); ?>  | <?php the_time('F j, Y'); ?> </span>
            </p>
        </div>
		
		     <?php
    endwhile;
endif;
	wp_reset_postdata();
	?>
    </div>
    <div class="s-button-div">
        <a href="" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Product Releases <i class="fas fa-arrow-right"></i> &nbsp;&nbsp;&nbsp;</a>
    </div>
</div>

<div class="section blog-width">
    <div class="featured">
        <div class="featured-heading row featured-heading-spacing">
            <div class="featured-title col-lg-3 col-md-12 col-sm-12">
                <p class="text-sm-center">Guest Bloggers</p>
            </div>
            <div class="featured-brief col-lg-8 col-md-12 col-sm-12">
                <p>Viverra adipiscing sapien facilisis pharetra viverra. Eros tristique arcu, convallis aliquet quisque ut sit nisl. Senectus sapien quis et, sollicitudin. Egestas venenatis molestie tincidunt bibendum ultrices laoreet arcu.</p>
            </div>
        </div>
    </div>

    <div class="blog-width">
        <hr>
    </div>
    <div class="section-blogs blog-width row featured-heading-spacing">

        <div class="section-blog-blogger col-lg-4 col-md-12 col-sm-12">
            <div class="bloggger">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name',34) ?> </span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="">Read Blogs <i class="fas fa-arrow-right"></i> </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(34,140); ?>
                </div>
            </div>
             <div class="bloggger">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name',36) ?> </span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="">Read Blogs <i class="fas fa-arrow-right"></i> </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(36,140); ?>
                </div>
            </div>
             <div class="bloggger">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name',31) ?> </span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="">Read Blogs <i class="fas fa-arrow-right"></i> </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(31,140); ?>
                </div>
            </div>
        </div>

        <div class="section-blog-blogger-center col-lg-4 col-md-12 col-sm-12">
            <div class="center-blogger-bg">
                <div class="center-blogger-image">
					<?php echo get_avatar(25); ?>
<!--                     <img src="/blog-assets/images/Megan_Walker.png" alt=""> -->
                </div>
                <div class="center-blogger">
                    <span class="center-blogger-name"><?php echo get_the_author_meta('display_name',25) ?></span> <br>
                    <span class="center-blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="">Read Blogs <i class="fas fa-arrow-right"></i> </a>
                </div>
            </div>
        </div>


        <div class="section-blog-blogger col-lg-4 col-md-12 col-sm-12">
            <div class="bloggger-right">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name',30) ?></span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="">Read Blogs <i class="fas fa-arrow-right"></i> </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(30,140); ?>
                </div>
            </div>
			<div class="bloggger-right">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name',27) ?></span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="">Read Blogs <i class="fas fa-arrow-right"></i> </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(27,140); ?>
                </div>
            </div>
			<div class="bloggger-right">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name',33) ?></span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="">Read Blogs <i class="fas fa-arrow-right"></i> </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(33,140); ?>
                </div>
            </div>
            
           
        </div>

    </div>
    <div class="s-button-div">
        <a href="" class="btn section-button">&nbsp;&nbsp;&nbsp;View More <i class="fas fa-arrow-right"></i> &nbsp;&nbsp;&nbsp;</a>
    </div>
</div>

<div class="cta-section">
    <div class="cta-section-content blog-width row featured-heading-spacing">
        <div class="cta-button col-md-6">
            <p>Want to know more about Coreplus Practice Management?</p>
        </div>
        <div class="col-md-6 cta-image">
            <a href="" class="btn section-button-white">&nbsp;&nbsp;&nbsp;&nbsp;Start Free Trial&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
    </div>
</div>

<?php 
//get_footer();
?>

