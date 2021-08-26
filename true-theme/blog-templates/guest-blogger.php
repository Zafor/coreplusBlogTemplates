<?php

/*
* Template Name: Guest Blogger
*/


?>

<div class="sub-menu-section">
    <div class="sub-menu blog-width">
        <?php get_template_part( 'partials/blog', 'menu' ); ?>
    </div>
</div>

<div class="about-blogger blog-width row">
    <div class="blogger-image-featured col-lg-6 col-md-6 col-sm-12">
        <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2020/03/Guest_Blogger_Image.jpg" alt="">
    </div>
    <div class="blog-details col-lg-6 col-md-6 col-sm-12">
        <div>
            <p class="blog-author">Author</p>
            <p class="author-name">Megan Walker</p>
            <p class="author-title">Medical Marketing Specialist <span class="the-bar">|</span> <span class="specialist"> <br></span> <span class="links">Market Savvy</span> </p>
            <div class="blogger-hyperlinks">
                <a href="">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="">
                    <i class="fas fa-globe"></i>
                </a>
            </div>
            <div class="author-bio">
                <p>Venenatis vivamus quam pretium id ut purus ullamcorper. Faucibus et pulvinar amet, mi laoreet ipsum eget purus augue. Et vestibulum lorem morbi sed sem semper varius scelerisque donec. Consectetur tristique consectetur aliquet sit blandit. Elit et dolor venenatis ornare lectus varius sodales aliquam quis. Commodo, turpis proin odio fermentum in accumsan.</p>
            </div>
        </div>
    </div>
</div>

<div class="section blog-width">
    <div class="blog-hyperlinks">
        <span class="left-line-author">
            <hr>
        </span>
        <span class="social-links author-links">
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-linkedin-in"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
            <a href=""><i class="fas fa-link"></i></a>
        </span>
        <span class="right-line-author">
            <hr>
        </span>
    </div>
</div>

<div class="container section">
    <div class="blog-width">
        <div class="section-blogs blog-width row">
		<?php 
	$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'author' => 25,
    'posts_per_page' => -1,
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
    </div>
</div>


<div class="cta-section">
    <div class="cta-section-content blog-width  row flex-column-reverse flex-lg-row flex-md-row">
        <div class="cta-button col-lg-6 col-md-6 col-sm-12">
            <p>Interested in becoming a guest blogger?</p>
            <a href="" class="btn section-button-white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Become Guest Blogger&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </div>
        <div class="col-md-6 cta-image">
            <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/become-guest-blogger.png" alt="">
        </div>
    </div>
</div>

<?php

?>
