<?php
    $idNo = get_the_ID();
    global $bannerID;
    
    $banner = get_field('page_banner_background_image', $idNo);
    
    if($banner != null)
    {
        ?>
        <div class="page-banner">
            <div class="page-banner-image-wrapper">
                <img src="<?=$banner['url']?>" alt="<?php the_title()?>" class="pageBannerImage">
            </div>
            <div class="page-banner-container">
                <div class="page-banner-container-right">
                    <div class="page-banner-table">
                        <div class="page-banner-cell">
                            <h2><?php echo do_shortcode(get_field('page_banner_line_1'))?></h2>
                            <h3><?php echo do_shortcode(get_field('page_banner_line_2'))?></h3>
                        </div>
                    </div>
                </div>
                <div class="page-banner-container-left">
                    <?php echo TrueLib::getACFImage('page_banner_overlay_image', 'main-banner-overlay', false, $idNo)?>
                </div>
                
                <div class="clear"></div>
            </div>
        </div>
        <?php
    }
