<?php

/**
 * Template Name: Blog
 */
?>


<div class="sub-menu-section">
    <div class="sub-menu blog-width">
        <?php get_template_part('partials/blog', 'menu'); ?>
    </div>
</div>

<div class="section desktop-bg-featured">
    <div class="blog-width">
        <div class="featured ">
            <div class="featured-heading row featured-heading-spacing announce-bg">
                <div class="featured-title">
                    <p class="text-sm-center"><?php echo get_field('blog_featured_title'); ?></p>
                </div>
                <div class="featured-brief">
                    <p><?php echo get_field('blog_featured_description'); ?></p>
                </div>
            </div>
        </div>

        <div class="blog-width">
            <hr class="line-opacity">
        </div>

        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'category_name' => 'featured',
            'posts_per_page' => 2,
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
                        <div class="post-image-cover ">
                            <div class="post-image  progressButton">
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
</div>

<div class="section desktop-bg-one">
    <div class="blog-width">

        <div class="keypoint-one-mobile row">
            <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/Diital-Health.png">
        </div>
        <div class="featured">
            <div class="featured-heading row featured-heading-spacing">
                <div class="featured-title">
                    <p class="text-sm-center"><?php echo get_field('blog_key_point_one_title'); ?></p>
                </div>
                <div class="featured-brief">
                    <p><?php echo get_field('blog_key_point_one_description'); ?></p>
                </div>
            </div>
        </div>
        <div class="blog-width">
            <hr class="line-opacity">
        </div>
        <div class="section-blogs blog-width row equal">
            <?php
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => 'digital-health',
                'posts_per_page' => 3,
            );
            $arr_posts = new WP_Query($args);

            if ($arr_posts->have_posts()) :

                while ($arr_posts->have_posts()) :
                    $arr_posts->the_post();
            ?>
                    <div class="section-blog col-lg-4 col-md-6 col-sm-12">
                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                        ?>
                        <div class="post-image-cover ">
                            <div class="post-image  progressButton">
                                <img src="<?php echo $url; ?>" />
                            </div>
                        </div>
                        <p class="blog-category">
                            <?php echo 'DIGITAL HEALTH' ?>

                        </p>
                        <p class="section-blog-title">
                            <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <div class="s-button-div">
            <a href="https://qa-web.coreplus.com.au/digital-health/" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Digital Health &#8594;&nbsp;&nbsp;</a>
        </div>
    </div>
</div>

<!-- flex-sm-row-reverse bs class for reversing row elements -->

<!--  -->
<?php get_template_part('partials/secure-messaging'); ?>
<!--  -->

<div class="section desktop-bg-two">
    <div class="blog-width">
        <div class="keypoint-two-mobile row">
            <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/Add-ons-1.png">
        </div>
        <div class="featured">
            <div class="featured-heading row featured-heading-spacing">
                <div class="featured-title">
                    <p class="text-sm-center"><?php echo get_field('blog_key_point_two_title'); ?></p>
                </div>
                <div class="featured-brief">
                    <p><?php echo get_field('blog_key_point_two_description'); ?></p>
                </div>
            </div>
        </div>

        <div class="blog-width">
            <hr class="line-opacity">
        </div>

        <div class="section-blogs blog-width row equal">
            <?php
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => 'online-add-ons-2',
                'posts_per_page' => 3,
            );
            $arr_posts = new WP_Query($args);

            if ($arr_posts->have_posts()) :

                while ($arr_posts->have_posts()) :
                    $arr_posts->the_post();
            ?>
                    <div class="section-blog col-lg-4 col-md-6 col-sm-12">
                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                        ?>
                        <div class="post-image-cover ">
                            <div class="post-image  progressButton">
                                <img src="<?php echo $url; ?>" />
                            </div>
                        </div>
                        <p class="blog-category">
                            <?php echo 'Add-ons' ?>

                        </p>
                        <p class="section-blog-title">
                            <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <div class="s-button-div">
            <a href="https://qa-web.coreplus.com.au/add-ons-page/" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Add-ons &#8594;&nbsp;&nbsp;</a>
        </div>
    </div>
</div>

<div class="section desktop-bg-three">
    <div class="blog-width">
        <div class="keypoint-three-mobile row">
            <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/Advisers-1.png">
        </div>
        <div class="featured">
            <div class="featured-heading row featured-heading-spacing">
                <div class="featured-title">
                    <p class="text-sm-center"><?php echo get_field('blog_key_point_three_title'); ?></p>
                </div>
                <div class="featured-brief">
                    <p><?php echo get_field('blog_key_point_three_description'); ?></p>
                </div>
            </div>
        </div>

        <div class="blog-width">
            <hr class="line-opacity">
        </div>

        <div class="section-blogs blog-width row equal">
            <?php
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => 'covid-19',
                'posts_per_page' => 3,
            );
            $arr_posts = new WP_Query($args);

            if ($arr_posts->have_posts()) :

                while ($arr_posts->have_posts()) :
                    $arr_posts->the_post();
            ?>
                    <div class="section-blog col-lg-4 col-md-6 col-sm-12">
                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                        ?>
                        <div class="post-image-cover ">
                            <div class="post-image  progressButton">
                                <img src="<?php echo $url; ?>" />
                            </div>
                        </div>
                        <p class="blog-category">
                            <?php echo 'Advisers' ?>

                        </p>
                        <p class="section-blog-title">
                            <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>

        <div class="s-button-div">
            <a href="https://qa-web.coreplus.com.au/advisers/" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Advisers &#8594;&nbsp;&nbsp;</a>
        </div>
    </div>
</div>

<!--  -->
<?php get_template_part('partials/subscribe-for-blogs'); ?>
<!--  -->

<div class="section desktop-bg-four">
    <div class="blog-width">
        <div class="keypoint-four-mobile row">
            <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/Practice-Life-1.png">
        </div>
        <div class="featured">
            <div class="featured-heading row featured-heading-spacing">
                <div class="featured-title">
                    <p class="text-sm-center"><?php echo get_field('blog_key_point_four_title'); ?></p>
                </div>
                <div class="featured-brief">
                    <p><?php echo get_field('blog_key_point_four_description'); ?></p>
                </div>
            </div>
        </div>

        <div class="blog-width">
            <hr class="line-opacity">
        </div>

        <div class="section-blogs blog-width row equal">
            <?php
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => 'health-practitioners',
                'posts_per_page' => 3,
            );
            $arr_posts = new WP_Query($args);

            if ($arr_posts->have_posts()) :

                while ($arr_posts->have_posts()) :
                    $arr_posts->the_post();
            ?>
                    <div class="section-blog col-lg-4 col-md-6 col-sm-12">
                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                        ?>
                        <div class="post-image-cover ">
                            <div class="post-image  progressButton">
                                <img src="<?php echo $url; ?>" />
                            </div>
                        </div>
                        <p class="blog-category">
                            <?php echo 'Practice Life' ?>

                        </p>
                        <p class="section-blog-title">
                            <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <div class="s-button-div">
            <a href="https://qa-web.coreplus.com.au/practice-life/" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Practice Life &#8594;&nbsp;&nbsp;</a>
        </div>
    </div>
</div>


<div class="section desktop-bg-five">
    <div class="blog-width">
        <div class="keypoint-five-mobile row">
            <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/Reimagining-Healthcare.png">
        </div>
        <div class="featured">
            <div class="featured-heading row featured-heading-spacing">
                <div class="featured-title">
                    <p class="text-sm-center"><?php echo get_field('blog_key_point_five_title'); ?></p>
                </div>
                <div class="featured-brief">
                    <p><?php echo get_field('blog_key_point_five_description'); ?></p>
                </div>
            </div>
        </div>

        <div class="blog-width">
            <hr class="line-opacity">
        </div>

        <div class="section-blogs blog-width row equal">
            <?php
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => 'new-feature',
                'posts_per_page' => 3,
            );
            $arr_posts = new WP_Query($args);

            if ($arr_posts->have_posts()) :

                while ($arr_posts->have_posts()) :
                    $arr_posts->the_post();
            ?>
                    <div class="section-blog col-lg-4 col-md-6 col-sm-12">
                        <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                        ?>
                        <div class="post-image-cover ">
                            <div class="post-image  progressButton">
                                <img src="<?php echo $url; ?>" />
                            </div>
                        </div>
                        <p class="blog-category">
                            <?php echo 'Product Releases' ?>

                        </p>
                        <p class="section-blog-title">
                            <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
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
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <div class="s-button-div">
            <a href="https://qa-web.coreplus.com.au/product-releases-blog/" class="btn section-button">&nbsp;&nbsp;&nbsp;View All Product Releases &#8594;&nbsp;&nbsp;</a>
        </div>
    </div>
</div>

<div class="section blog-width">
    <div class="featured">
        <div class="featured-heading row featured-heading-spacing">
            <div class="featured-title">
                <p class="text-sm-center"><?php echo get_field('guest_bloggers_title'); ?></p>
            </div>
            <div class="featured-brief">
                <p><?php echo get_field('guest_bloggers_description'); ?></p>
            </div>
        </div>
    </div>

    <div class="blog-width">
        <hr class="line-opacity">
    </div>
    <div class="section-blogs blog-width row featured-heading-spacing">

        <div class="section-blog-blogger col-lg-4 col-md-12 col-sm-12">
            <div class="bloggger">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name', 34) ?> </span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="<?php echo esc_url(get_author_posts_url(34)); ?>" title="<?php echo esc_attr(get_the_author()); ?>">Read Blogs &#8594; </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(34, 140); ?>
                </div>
            </div>
            <div class="bloggger">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name', 36) ?> </span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="<?php echo esc_url(get_author_posts_url(36)); ?>" title="<?php echo esc_attr(get_the_author()); ?>">Read Blogs &#8594; </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(36, 140); ?>
                </div>
            </div>
            <div class="bloggger">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name', 31) ?> </span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="<?php echo esc_url(get_author_posts_url(31)); ?>" title="<?php echo esc_attr(get_the_author()); ?>">Read Blogs &#8594; </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(31, 140); ?>
                </div>
            </div>
        </div>

        <div class="section-blog-blogger-center col-lg-4 col-md-12 col-sm-12">
            <div class="center-blogger-bg">
                <div class="center-blogger-image">
                    <?php //echo get_avatar(25); 
                    ?>
                    <!--                     <img src="/blog-assets/images/Megan_Walker.png" alt=""> -->
                    <img src="https://qa-web.coreplus.com.au/wp-content/uploads/2021/06/IMG.png" alt="Featured Blogger">
                </div>
                <div class="center-blogger">
                    <span class="center-blogger-name"><?php echo get_the_author_meta('display_name', 25) ?></span> <br>
                    <span class="center-blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="<?php echo esc_url(get_author_posts_url(25)); ?>" title="<?php echo esc_attr(get_the_author()); ?>">Read Blogs &#8594; </a>
                </div>
            </div>
        </div>


        <div class="section-blog-blogger col-lg-4 col-md-12 col-sm-12">
            <div class="bloggger-right">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name', 30) ?></span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="<?php echo esc_url(get_author_posts_url(30)); ?>" title="<?php echo esc_attr(get_the_author()); ?>">Read Blogs &#8594;</a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(30, 140); ?>
                </div>
            </div>
            <div class="bloggger-right">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name', 27) ?></span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="<?php echo esc_url(get_author_posts_url(27)); ?>" title="<?php echo esc_attr(get_the_author()); ?>">Read Blogs &#8594; </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(27, 140); ?>
                </div>
            </div>
            <div class="bloggger-right">
                <div class="blogger-details">
                    <span class="blogger-name"><?php echo get_the_author_meta('display_name', 33) ?></span> <br>
                    <span class="blogger-designation">Co-Founder & CEO of
                        CureVentus</span><br>
                    <a href="<?php echo esc_url(get_author_posts_url(33)); ?>" title="<?php echo esc_attr(get_the_author()); ?>">Read Blogs &#8594; </a>
                </div>
                <div class="blogger-image">
                    <?php echo get_avatar(33, 140); ?>
                </div>
            </div>


        </div>

    </div>
    <div class="s-button-div">
        <a href="" class="btn section-button">&nbsp;&nbsp;&nbsp;View More &#8594;&nbsp;&nbsp;</a>
    </div>
</div>

<!--  -->
<?php get_template_part('partials/start-free-trial'); ?>
<!--  -->