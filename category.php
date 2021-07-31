<div class="sub-menu-section">
    <div class="sub-menu blog-width">

        <?php get_template_part('partials/blog', 'menu'); ?>

    </div>
</div>

<div class="section blog-width">
    <h3><?php single_cat_title(__('Currently browsing ', 'textdomain')); ?>...</h3>
</div>

<div class="section blog-width">
    <hr class="line-opacity">
</div>

<div class="section blog-width">
    <div class="section-blogs blog-width row equal">
        <?php
        $cat = get_term_by('name', single_cat_title('', false), 'category');
        $cat_slug = $cat->slug;
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'category_name' => $cat_slug,
            'posts_per_page' => -1,
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
                        <?php echo $cat_slug; ?>
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
        <!-- 		 -->
    </div>
    <div class="s-button-div">
        <a href="">Read More <i class="fas fa-arrow-right"></i> </a>

    </div>

</div>



<!--  -->
<?php get_template_part('partials/secure-messaging'); ?>
<!--  -->