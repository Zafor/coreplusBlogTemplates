<?php
    $idNo = get_the_ID();


    global $bannerID, $bannerOverrideLine1, $bannerOverrideLine2, $bannerOverrideLine3;

    if($bannerID != null)
    {
        $idNo = $bannerID;
    }

    $line1 = get_field('banner_line_1', $idNo);
    $line2 = get_field('banner_line_2', $idNo);
    $line3 = get_field('banner_line_3', $idNo);

    if($bannerOverrideLine1 !== null)
    {
        $line1 = $bannerOverrideLine1;
    }

    if($bannerOverrideLine2 !== null)
    {
        $line2 = $bannerOverrideLine2;
    }

    if($bannerOverrideLine3 !== null)
    {
        $line3 = $bannerOverrideLine3;
    }

    
    /*$bannerTitle = get_the_title();
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
    }*/

?>
<div class="top-banner">
    <div class="wrapper">
        <div class="site-content">
            <?php 
                if($line1 != '')
                {
                    ?>
                    <h2><?=do_shortcode($line1)?></h2>
                    <?php
                }

                if($line2 != '')
                {
                    ?>
                    <h1><?=$line2?></h1>
                    <?php
                }

                if($line3 != '')
                {
                    ?>
                    <h3><?=$line3?></h3>
                    <?php
                }
            ?>
        </div>
    </div>  
</div>