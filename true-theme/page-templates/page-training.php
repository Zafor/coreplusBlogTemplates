<?php
/**
 * Template Name: Training
 *
 */

$hasWebinars = false;

if(get_field('webinar')):
    $hasWebinars = true;
endif;
?>
<div class="v1-theme">
    <?php
        TrueLib::getTemplatePart('page-banner');
    ?>
    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
        <div id="primary" class="site-content">
            <div id="content" role="main">
      
                <?php TrueLib::getTemplatePart('page-statement')?>
                
                <?php if($hasWebinars): ?>
                <div class="practice-left">                
                <?php endif; ?> 
                    <h3 class="section-title"><?php echo get_field('subtitle')?></h3>
                    <div class="sub-page-description entry-content">
                        <?php the_field('description')?>
                    </div>
                </div>
                
                <?php if($hasWebinars): ?>
                </div>
                <!-- Training Right -->
                <div class="practice-right">
                    <h3 class="section-title"><?php echo get_field('webinars_title')?></h3>
                    <div class="webinar-list">
                        <?php
                            while(has_sub_field('webinar'))
                            {
                                ?>
                                <div class="training-webinar-item">
                                    <a href="<?php echo get_sub_field('link_url')?>">
                                        <?php echo get_sub_field('text')?>
                                    </a>    
                                </div>
                                <?php
                            }
                        ?>
                    </div>

                </div>
                <?php endif; ?>
                <div class="clear"></div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>