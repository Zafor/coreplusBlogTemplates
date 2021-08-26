<?php
/**
 * Template Name: Referrer Network
 *
 */

?>

<div class="v1-theme">
    <?php
        TrueLib::getTemplatePart('page-banner');  
    ?>

    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
        <div id="primary" class="site-content">
            <div id="content" role="main">
      
                <?php TrueLib::getTemplatePart('page-statement-icon')?>
                <!-- Referrer Left -->
                <div class="referrer-left">
                    <h3 class="section-title"><?php echo get_field('secondary_title')?></h3>
                    <div class="sub-page-description">
                        <?php the_field('description')?>
                    </div>
                </div>
                
                <!-- Referrer Right -->
                <div class="referrer-right">
                    <?php
                        if(get_field('referrer'))
                        {
                            while(has_sub_field('referrer'))
                            {
                                ?>
                                <div class="referrer-section">
                                    <div class="entry-content">
                                        <div class="referrer-block-image">
                                            <?php echo TrueLib::getACFImage('image', '', true)?>
                                        </div>
                                        <div class="referrer-block-text">
                                            <?php the_sub_field('description')?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <?php
                            }    
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>