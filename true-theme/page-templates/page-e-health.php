<?php
/**
 * Template Name: e-Health
 *
 */

?>
<div class="v1-theme">
    <?php TrueLib::getTemplatePart('page-banner') ?>
    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
        <div id="primary" class="site-content">
            <div id="content" role="main">
                <?php TrueLib::getTemplatePart('page-statement-icon')?>
            
                <h3 class="section-title"><?php echo get_field('subtitle')?></h3>
                <div class="sub-page-description">
                    <?php the_field('description')?>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>