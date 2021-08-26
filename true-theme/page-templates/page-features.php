<?php
/**
 * Template Name: Features Accordian Tabs
 *
 */
    $tabs = TrueFeatures::getTabs();
    if (get_the_id() == FEATURES_PAGE_ID) {
        $postURL = get_permalink($tabs[0]);
        
        header('Location: ' . $postURL);
        die;
    }
 
    if (empty(get_field('banner_line_1'))):
        $bannerID = FEATURES_PAGE_ID;
    endif;
    
?>  
<div class="layout-block--colour-white">
    <div class="v1-theme v1-theme--no-padding">
        <div class="features">
            <?php
                TrueLib::getTemplatePart('page-banner');
                
                $page_descriptions = array();
                $tab_contents = array();
                
                //Tabs
                if (count($tabs) > 0):
                    $currentTab = TrueFeatures::getCurrentTab($tabs);
                    
                    if ($currentTab != null): ?>
                        <?=view('features/navbar', [
                            'tabs' => $tabs,
                            'currentTab' => $currentTab
                            ]) ?>
                        <?php
                    endif;
                endif;
            ?>
        </div>
    </div>
    <?php
        $post = $currentTab;
        setup_postdata($post);
        //Create the content section!!
    ?>
    <?=view('features/image-banner') ?>
    <div class="v1-theme">
        <div class="wrapper">
            <div id="primary" class="site-content features">
                <?=view('features/default') ?>
            </div>
        </div>
    </div>
    <?php
        wp_reset_postdata();
    ?>
</div>