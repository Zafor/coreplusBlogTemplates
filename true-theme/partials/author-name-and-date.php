<span> By
    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(get_the_author()); ?>"><?php the_author(); ?>
    </a> | <?php the_time('M d, Y'); ?>
</span>