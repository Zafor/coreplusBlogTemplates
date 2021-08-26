<?php
/**
 * Template Name: Online Add-Ons
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

                    <?php
                        if(get_field('section'))
                        {
                            while(has_sub_field('section'))
                            {
                                
                                ?>
                                <div class="practice-section">
                                    <h3 class="section-title"><?php echo get_sub_field('title')?></h3>
                                    
                                    <?php
                                        if(get_sub_field('companies'))
                                        {
                                            while(has_sub_field('companies'))
                                            {
                                                $image = TrueLib::getACFImage('company_logo', '', true);
                                                $rightCol = 'right';
                                                
                                                if($image == '')
                                                {
                                                    $rightCol = 'left full';
                                                }
                                                
                                                ?>
                                                <div class="generic-section-block online-addons">
                                                    <div class="generic-page-left entry-content add-ons-image-logo">
                                                        <?php echo $image ?>
                                                    </div>
                                                    
                                                    <div class="generic-page-<?php echo $rightCol?> entry-content">
                                                        <?php the_sub_field('description')?>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <?php 
                                            }  
                                        }
                                        
                                    ?>
                                </div>
                                <?php
                                
                            }
                        }
                    ?>
                </div>
                
                <!-- Practice Right -->
                <div class="practice-right">
                    <?php
                        if(get_field('right_section'))
                        {
                            while(has_sub_field('right_section'))
                            {
                                ?>
                                <div class="practice-section">
                                    <h3 class="section-title"><?php echo get_sub_field('title')?></h3>
                                    <?php
                                        if(get_sub_field('companies'))
                                        {
                                            while(has_sub_field('companies'))
                                            {
                                                $image = TrueLib::getACFImage('company_logo', '', true);
                                                $rightCol = 'right';
                                                
                                                if($image == '')
                                                {
                                                    $rightCol = 'left full';
                                                }
                                                
                                                ?>
                                                <div class="generic-section-block online-addons">
                                                    <div class="generic-page-left entry-content add-ons-image-logo">
                                                        <?php echo $image ?>
                                                    </div>
                                                    
                                                    <div class="generic-page-<?php echo $rightCol?> entry-content">
                                                        <?php the_sub_field('description')?>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <?php 
                                            }  
                                        }
                                        
                                    ?>
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
                <div class="clear"></div>
                
                <div class="online-addons-bottom-description entry-content">
                    <?php the_field('bottom_content')?>
                </div>
                
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>