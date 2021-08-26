<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

?>
<div class="v1-theme">
	<!-- Main Banner -->
	<div class="top-banner">
		<div class="wrapper">
	    	<div class="site-content">
				<h1><?=get_field('banner_line_1','options')?></h1>
				<h2><?=get_field('banner_line_2','options')?></h2>
				<h3><?=get_field('banner_line_3','options')?></h3>
			</div>
		</div>  
	</div>

	<div class="breadcrumbs wrapper">
				home > the practice happy blog
	</div>

	<div id="main" class="wrapper">
		<div id="primary" class="site-content">
			<div id="content" role="main">
			
			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php twentytwelve_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
					</header>

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->

				</article><!-- #post-0 -->

			<?php endif; // end have_posts() check ?>

			</div><!-- #content -->
		</div><!-- #primary -->

	<?php get_sidebar(); ?>
	</div>
</div>