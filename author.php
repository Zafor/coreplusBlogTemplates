<?php
$author_id = get_queried_object_id();
$blogger_designation = get_field('blogger_designation', 'user_' . $author_id);
$company_name = get_field('company_institution_name', 'user_' . $author_id);
?>

<div class="sub-menu-section">
    <div class="sub-menu blog-width">

        <?php get_template_part('partials/blog', 'menu'); ?>

    </div>
</div>

<div class="about-blogger blog-width row blogger-top-space">
    <div class="blogger-image-featured col-lg-6 col-md-6 col-sm-12">
        <?php
        //echo get_avatar(get_the_author_meta('ID'), 500);  
        ?>
        <img src="<?php echo get_field('blogger_profile_picture', 'user_' . $author_id); ?>">
    </div>
    <div class="blog-details col-lg-6 col-md-6 col-sm-12">
        <div>
            <p class="blog-author">Author</p>
            <p class="author-name"><?php echo get_the_author_meta('display_name'); ?></p>
            <p class="author-title"><?php echo $blogger_designation ?> <span class="the-bar"><?php if ($blogger_designation != null && $company_name != null) echo "|" ?></span> <span class="specialist"> <br></span> <span class="links"><?php echo $company_name ?></span> </p>
            <!-- 			 -->
            <?php //$author_id = get_the_author_meta('ID'); 
            ?>
            <? php // echo get_user_meta( $author_id, 'wpseo_title', true ); 
            ?>
            <!-- 			 -->
            <div class="blogger-hyperlinks">
                <a href="<?php echo get_field('linked_in_url', 'user_' . $author_id); ?>" target="_blank">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="<?php echo get_field('instagram_url', 'user_' . $author_id); ?>" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="<?php echo get_field('facebook_url', 'user_' . $author_id); ?>" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="<?php echo get_field('twitter_url', 'user_' . $author_id); ?>" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="<?php echo get_field('website_url', 'user_' . $author_id); ?>" target="_blank">
                    <i class="fas fa-globe"></i>
                </a>
            </div>
            <div class="author-bio">
                <p><?php echo get_field('blogger_details', 'user_' . $author_id); ?></p>
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
            <div class="social">
                <?php
                $attributes = "";
                $customURL = get_permalink();
                $customTitle = the_title_attribute('echo=0');
                if ($customURL != '') {
                    $attributes = 'addthis:url="' . $customURL . '" ';
                    $attributes .= ' addthis:counturl="' . $customURL . '" ';
                }

                if ($customTitle != '') {
                    $attributes .= 'addthis:title="' . $customTitle . '"';
                }

                ?>
                <!-- AddThis Button BEGIN addthis_32x32_style -->
                <div class="addthis_toolbox addthis_default_style" <?= $attributes ?>>
                    <a class="addthis_button_facebook"><img alt="Facebook Social Icon" class="retina-icon" src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/3.png"></a>
                    <a class="addthis_button_linkedin"><img alt="LinkedIn Social Icon" class="retina-icon" src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/2.png"></a>
                    <a class="addthis_button_more"><img alt="More Social Icon" class="retina-icon" src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/Untitled-design.png"></a>
                    <!--                     <a class="addthis_counter addthis_bubble_style"></a> -->
                </div>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script>
                <!-- AddThis Button END -->
            </div>
        </span>
        <span class="right-line-author">
            <hr>
        </span>
    </div>
</div>

<div class="container section">
    <?php
    $authorID = get_the_author_meta('ID');
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'author' => $authorID,
        'posts_per_page' => -1,
    );
    $arr_posts = new WP_Query($args);

    if ($arr_posts->have_posts()) : ?>
        <div class="featured-blogs blog-width row equal">

            <?php while ($arr_posts->have_posts()) :
                $arr_posts->the_post();
            ?>

                <div class="featured-blog col-lg-6 col-md-6 col-sm-12">
                    <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    ?>
                    <div class="post-image-cover">
                        <div class="post-image">
                            <img src="<?php echo $url; ?>" />
                        </div>
                    </div>
                    <p class="blog-category">
                        <?php echo 'Featured' ?>

                    </p>
                    <p class="blog-title">
                        <a class="blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </p>
                    <p>
                        <?php the_excerpt(); ?>
                    </p>
                    <p class="blogging-info">

                        <span class="blogger-thumbnail">
                            <?php echo get_avatar(get_the_author_meta('ID'), 42); ?>
                        </span>
                        <?php get_template_part('partials/author-name-and-date'); ?>
                    </p>
                </div>
            <?php
            endwhile; ?>
        </div>

    <?php
    endif;
    wp_reset_postdata();
    ?>
</div>

<?php get_template_part('partials/become-guest-blogger'); ?>