<div class="v1-theme">    
    <div class="container">
    
    <?php while (have_posts()) : the_post(); ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
      <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
    <?php endwhile; ?>
    </div>
</div>