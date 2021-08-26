<?php
    $idNo = get_the_ID();
    global $bannerID, $bannerOverrideTitle, $bannerOverrideDescription;
    $bannerTitle = get_the_title();
    $bannerDescription = '';
    if(isset($bannerID))
    {
        if($bannerID != null)
        {
            $idNo = $bannerID;

            if(isset($bannerOverrideTitle))
            {
                $bannerTitle = $bannerOverrideTitle;
            }
        }
    }   
    
    if(isset($bannerOverrideDescription))
    {
        $bannerDescription = $bannerOverrideDescription;
    }

    $banner = get_field('banner_image', $idNo);

    if($banner)
    {
        if($bannerDescription == '')
        {
            $bannerDescription = get_field('banner_text', $idNo);
        }
        ?>
        <!-- Start Main Banner -->
        <div class="page-banner">
            <img src="<?=$banner['url']?>" class="pageBannerImage">
        </div> <!-- End Main Banner -->
        <?php
    }
?>