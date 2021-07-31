<?php

$s = get_search_query();
$args = array(
    's' => $s
);
// The Query
$the_query = new WP_Query($args);

if ($the_query->have_posts()) :
?>

    <div class="sub-menu-section">
        <div class="sub-menu blog-width">
            <?php get_template_part('partials/blog', 'menu'); ?>
        </div>
    </div>
    <!-- the loop -->

    <div class="section blog-width">
        <h1 class="page-title"><?php printf(__('Search Results for %s', 'shape'), '<span>' . get_search_query() . '</span>'); ?></h1>
        <div class="section blog-width">
            <hr class="line-opacity">
        </div>

        <div class="section-blogs blog-width row equal">
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                <div class="section-blog col-lg-4 col-md-6 col-sm-12">
                    <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    ?>
                    <div class="post-image-cover">
                        <div class="post-image">
                            <img src="<?php echo $url; ?>" />
                        </div>
                    </div>
                    <!-- get post category -->
                    <?php
                    $category = get_the_category();
                    if ($category[0]) {
                        echo '<p class="blog-category"><a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a></p>';
                    }
                    ?>
                    <!-- end category -->
                    <!-- blog title -->
                    <p class="section-blog-title">
                        <a class="section-blog-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </p>
                    <!-- End of blog title -->
                    <!-- Blog Excerpt -->
                    <p>
                        <?php the_excerpt(); ?>
                    </p>
                    <!-- End of blog excepts -->

                    <!-- blogger infor -->
                    <p class="blogging-info">
                        <span class="blogger-thumbnail">
                            <?php echo get_avatar(get_the_author_meta('ID'), 42); ?>
                        </span>
                        <?php get_template_part('partials/author-name-and-date'); ?>
                    </p>
                    <!-- end of blogger info -->
                </div>
            <?php endwhile; ?>
        </div>

    </div>

    <!-- end of the loop -->

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <div class="sub-menu-section">
        <div class="sub-menu blog-width">
            <?php get_template_part('partials/blog', 'menu'); ?>
        </div>
    </div>
    <?php get_template_part('404') ?>
<?php endif; ?>