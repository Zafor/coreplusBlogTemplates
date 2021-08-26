<?php
/**
 * Template Name: Medicare / Cash Flow
 *
 */
    
    function printMedicateSection() {
        ?>
        <div class="cash-flow-section">
            <h3 class="section-title"><?php echo get_sub_field('section_title')?></h3>
            <div class="sub-page-description entry-content">
                <?php the_sub_field('section_description')?>
            </div>
        </div>
        <?php
    }
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
                
                <!-- Cash Flow Left -->
                <div class="cash-flow-left">
                    <?php
                        if(get_field('left_content'))
                        {
                            while(has_sub_field('left_content'))
                            {
                                printMedicateSection();
                            }    
                        }
                    ?>
                </div>
                
                <!-- Cash Flow Right -->
                <div class="cash-flow-right">
                    <?php
                        if(get_field('right_content'))
                        {
                            while(has_sub_field('right_content'))
                            {
                                
                                printMedicateSection();
                            }    
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>