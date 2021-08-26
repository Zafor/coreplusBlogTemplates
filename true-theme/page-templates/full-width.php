<?php
/**
 * Template Name: Full-width
 */

?>
<div class="v1-theme">
<?php
    get_template_part('page-templates/page-banner');
?>

<!-- Main Banner -->
    <div class="main-banner">
        <div class="main-banner-controls-outer">
            <div class="main-banner-controls-container">
                <div class="main-banner-controls">
                    
                </div>
            </div>
        </div>
        
        <?php
            $banner = get_field('main_banner');
           
            if($banner)
            {
                $slider = new TrueSlider($banner->ID);
                echo $slider->showSlider();
    
            }
        ?>
        <div class="clear"></div>
    </div>


<div id="main" class="wrapper">
    <div id="primary" class="site-content">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <div class="box-container">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->
    </div><!-- #primary -->
</div>
</div>