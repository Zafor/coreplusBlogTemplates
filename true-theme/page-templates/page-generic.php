<?php
/**
 * Template Name: Generic Page
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
      
                <?php TrueLib::getTemplatePart('page-statement')?>

                <?php
                    if(get_field('sections')) {
                        while(has_sub_field('sections')) {
                            $two = get_sub_field('two_columns');
                            ?>
                            <div class="generic-section-block">
                                <!-- Generic Page Left -->
                                <div class="generic-page-left<?php if(!$two) echo ' full'?>">  
                                    <?php if(!empty(get_sub_field('section_title'))): ?>
                                    <h3 class="section-title"><?php echo get_sub_field('section_title')?></h3>
                                    <?php endif; ?>
                                    <div class="sub-page-description entry-content">
                                        <?php the_sub_field('section_description')?>
                                    </div>
                                </div>
                                
                                <?php
                                    if($two) {
                                        ?>
                                        <!-- Generic Page Right -->
                                        <div class="generic-page-right">
                                            <?php if(!empty(get_sub_field('right_column_title'))): ?>
                                            <h3 class="section-title"><?php echo get_sub_field('right_column_title')?></h3>
                                            <?php endif; ?>
                                            <div class="sub-page-description entry-content">
                                                <?php the_sub_field('right_description')?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?> 
                                
                                <div class="clear"></div>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>