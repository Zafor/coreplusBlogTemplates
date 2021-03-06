<?php

/*
* Template Name: Blog Category-Add ons
*/

?>

<div class="sub-menu-section">
    <div class="sub-menu blog-width">

        <?php get_template_part('partials/blog', 'menu'); ?>

    </div>
</div>

<div class="section">
    <div class="blog-width">
        <div class="keypoint-header-content row">
            <div class="keypoint-header-image  col-md-6 col-md-push-6">
                <img src="<?php echo get_field('blog_key_point_two_image') ?>" alt="">
            </div>
            <div class="keypoint-header-content-details col-md-6 col-md-pull-6">
                <h3 class="keypoint-header-title"><?php echo get_field('blog_key_point_two_title'); ?></h3>
                <p><?php echo get_field('blog_key_point_two_description'); ?></p>
            </div>

        </div>
    </div>
</div>

<div class="section blog-width">
    <hr class="line-opacity">
</div>

<div class="section blog-width">
    <div class="section-blogs blog-width row equal">
        <?php
        $ourCurrentPage = get_query_var('paged');
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'category_name' => 'online-add-ons-2',
            'posts_per_page' => 9,
            'paged' => $ourCurrentPage
        );
        $arr_posts = new WP_Query($args);

        if ($arr_posts->have_posts()) :

            while ($arr_posts->have_posts()) :
                $arr_posts->the_post();
        ?>
                <div class="section-blog col-lg-4 col-md-6 col-sm-12">

                    <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    ?>
                    <div class="post-image-cover">
                        <div class="post-image">
                            <img src="<?php echo $url; ?>" />
                        </div>
                    </div>
                    <p class="blog-category">
                        <?php echo 'Add ons' ?>

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
</div>

<!--  -->
<div class="text-center">
    <div style="margin:auto; padding-top:50px; padding-bottom:50px">
        <?php

        echo paginate_links(array(
            'total' => $arr_posts->max_num_pages
        ));

        ?>
    </div>
</div>
<!--  -->

<!--  -->
<?php get_template_part('partials/secure-messaging'); ?>
<!--  -->



<?php

?>