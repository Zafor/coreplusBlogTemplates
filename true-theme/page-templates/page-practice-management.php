<?php
/**
 * Template Name: Practice Management
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
                
                <!-- Practice Left -->
                <div class="practice-left">
                    <div class="practice-sub-title">
                        <?php echo get_field('secondary_statement')?>
                    </div>
                    
                    <?php
                        if(get_field('content'))
                        {
                            while(has_sub_field('content'))
                            {
                                ?>
                                <div class="practice-section">
                                    <h3 class="section-title"><?php echo get_sub_field('section_title')?></h3>
                                    <div class="sub-page-description entry-content">
                                        <?php the_sub_field('section_description')?>
                                    </div>
                                </div>
                                <?php
                                
                            }
                        }
                    ?>
                </div>
                
                <!-- Practice Right -->
                <div class="practice-right">
                    <?php
                        if(get_field('dot_points'))
                        {
                            ?>
                            <ul class="list">
                                <?php
                                    while(has_sub_field('dot_points'))
                                    {
                                        ?>
                                        <li><?php echo get_sub_field('dot_point')?></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                            <?php    
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>