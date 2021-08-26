<?php
    /**
     * Template Name: Partners
     *
     */
    
?>
<div class="v1-theme">
    <?php TrueLib::getTemplatePart('page-banner'); ?>

    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
        <div id="primary" class="site-content">
            <div id="content" role="main">
                
                <?php TrueLib::getTemplatePart('page-statement-icon')?>
                
                <?php
                    if( have_rows('partners') ):
                        ?>
                        <div class="customer-carosel">
                            <ul class="customer-slider">
                         
                                <?php
                                    // loop through the rows of data
                                    while ( have_rows('partners') ) : the_row();

                                        $linkStart = '';
                                        $linkEnd = '';
                                        if(trim(get_sub_field('partner_url')) != '')
                                        {
                                            $linkStart = '<a href="' . trim(get_sub_field('partner_url')) . '" target="_blank">';
                                            $linkEnd = '</a>';
                                        }

                                        $hasDescription = true;
                                        if(trim(get_sub_field('partner_description')) == '' || trim(get_sub_field('partner_description')) == '<p></p>')
                                        {
                                            $hasDescription = false;
                                        }
                                        ?>
                                        <li>
                                            <?php
                                                if($hasDescription)
                                                {
                                                    ?>
                                                    <div class="lhs">
                                                        <h2><?=get_sub_field('partner_name') ?></h2> 
                                                        <div class="entry-content">
                                                            <?=get_sub_field('partner_description');?>
                                                        </div>
                                                    </div>
                                                    <div class="rhs">
                                                        <?php echo $linkStart;?>
                                                        <div class="image-container">
                                                            <div class="image-container-inner">
                                                                <div class="image-container-table">
                                                                    <div class="image-container-content">
                                                                        <?php
                                                                            $image = get_sub_field('partner_logo');
                                                                        ?>
                                                                        <img alt="<?=$image['alt']?>" title="<?=$image['title']?>" src="<?=$image['sizes']['customer-banner']?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php echo $linkEnd;?>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="rhs full-width">
                                                        <?php echo $linkStart;?>
                                                        <div class="image-container" style="margin:auto">
                                                            <div class="image-container-inner">
                                                                <div class="image-container-table">
                                                                    <div class="image-container-content">
                                                                        <?php
                                                                            $image = get_sub_field('partner_logo');
                                                                        ?>
                                                                        <img alt="<?=$image['alt']?>" title="<?=$image['title']?>" src="<?=$image['sizes']['customer-banner']?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php echo $linkEnd;?>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                        </li>
                                        <?php
                                    endwhile;
                                ?>
                            </ul>
                        </div> <!-- customer carosel -->
                        <div class="clear-fixer-div"></div>
                        <?php
                    endif;
                ?>

                <!-- Page Content -->
                <?php
                    function printPartnersText($side, $last = false)
                    {
                        ?>
                        <div class="partners-section-column partners-section-text <?php echo $side?> <?php if($last) echo 'last'?>">
                            <?php
                                if(trim(get_sub_field('title')) != '')
                                {
                                    ?>
                                    <h3 class="section-title"><?php the_sub_field('title')?></h3>
                                    <?php
                                }
                            ?>
                            <div class="description">
                                <div class="entry-content">
                                    <?php the_sub_field('description')?>
                                </div>
                            </div>
                        </div> 
                        <?php
                    }
                    
                    function printPartnersImage($side, $last = false)
                    {
                        $image = TrueLib::getACFImage('image', '', true);
                        if($image != '')
                        {
                            ?>
                            <div class="partners-section-column partners-section-image <?php echo $side?> <?php if($last) echo 'last'?>">
                                <?php echo $image?>
                                &nbsp;
                            </div>
                            <?php
                        }    
                    }

                    if(get_field('content_row'))
                    {
                        while(has_sub_field('content_row'))
                        {
                            $showOnLeft = get_sub_field('show_image_on_left');
                            ?>
                            <div class="partners-section">
                                <?php
                                    if(!$showOnLeft)
                                    {
                                        printPartnersText('left');
                                        printPartnersImage('right', true);
                                    } else {
                                        printPartnersText('right', true);
                                        printPartnersImage('left');
                                    }
                                ?>
                                <div class="clear"></div>
                            </div>
                            <?php
                        }
                    }
                ?>
                <!-- Left -->
                <div class="partners-left">                
                    <?php
                        if(get_field('left_column'))
                        {
                            while(has_sub_field('left_column'))
                            {
                                ?>
                                <div class="practice-section">
                                    <?php
                                        if(trim(get_sub_field('title')) != '')
                                        {
                                            ?>
                                            <h3 class="section-title"><?php echo get_sub_field('title')?></h3>
                                            <?php
                                        }
                                    ?>
                                    
                                    <div class="sub-page-description entry-content">
                                        <?php the_sub_field('description')?>
                                    </div>
                                </div>
                                <?php
                                
                            }
                        }
                    ?>
                </div>
                
                <!-- Right -->
                <div class="partners-right">
                    <?php
                        if(get_field('features'))
                        {
                            ?>
                            
                            <h3 class="section-title"><?php the_field('features_title')?></h3>
                            <ul class="list">
                                <?php
                                    while(has_sub_field('features'))
                                    {
                                        ?>
                                        <li><?php the_sub_field('feature')?></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                            
                          <?php
                        }
                    ?>
                    <div class="entry-content">
                        <?php the_field('bottom_description')?>
                    </div>
                    
                </div>
                <div class="clear"></div>
                
                
                <div class="partner-form grid_container">
                    <h3 class="dark-heading" id="partnerform"><?php echo get_field('partner_form_title')?></h3>
                    <?php echo do_shortcode('[contact-form-7 id="890" title="Partner Form"]')?>
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>