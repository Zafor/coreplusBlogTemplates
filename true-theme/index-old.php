<?php if (!have_posts()) : ?>
  <div class="container">
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'roots'); ?>
    </div>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <div class="container">
    <?php get_template_part('templates/content', get_post_format()); ?>
  </div>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <div class="container">
    <nav class="post-nav">
      <ul class="pager">
        <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
        <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
      </ul>
    </nav>
  </div>
<?php endif; ?>
