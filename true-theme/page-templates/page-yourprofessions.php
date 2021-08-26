<?php
/**
 * Template Name: Your Professions
 *
 */

    global $bannerID;
    $bannerID = PROFESSIONS_PAGE_ID;

?>
<div class="v1-theme">
    <?php TrueLib::getTemplatePart('page-banner') ?>
    <div id="main" class="wrapper your-profession">
        <?php createTrueBreadcrumb()?>
        <div id="primary" class="site-content">
            <div id="content" role="main">
            	<?php
                    TrueLib::getTemplatePart('professions-navigation');

                    if (trim(get_field('page_title')) != '') {
                        ?>
                        <h2 class="bold-title tc pros1"><?=get_field('page_title')?></h2> 
                        <?php
                    }

                    if (trim(get_field('page_description')) != '') {
                        ?>
                        <div class='entry-content page-description'>
                            <?php echo get_field('page_description')?>    
                        </div>
                        <?php
                    }
                ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>