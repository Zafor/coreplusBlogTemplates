<?php
    
    $currentTerm = get_queried_object();

    if(get_field('published_status', $currentTerm) == 'DRAFT')
    {
        header("HTTP/1.0 404 Not Found");
        require TEMPLATEPATH.'/404.php';
        exit;
    }
    
    if($currentTerm->parent == 0) {
        //wp_redirect( get_permalink(PROFESSIONS_PAGE_ID), 301 );
            global $bannerID, $bannerOverrideLine1, $bannerOverrideLine2;
            $bannerID = PROFESSIONS_PAGE_ID;

            $bannerOverrideLine1 = get_field('profession_pages_step_1_line_1', PROFESSIONS_PAGE_ID);
            $bannerOverrideLine2 = get_field('profession_pages_step_1_line_2', PROFESSIONS_PAGE_ID);

            $bannerOverrideLine2 = str_replace('%profession_name%', ucfirst($currentTerm->name), $bannerOverrideLine2);
        ?>
        
        <div class="v1-theme">
            <?php
                TrueLib::getTemplatePart('page-banner');  
            ?>
            <div id="main" class="wrapper">
                <?php createTrueBreadcrumb()?>
                <div id="primary" class="site-content">
                    <div id="content" role="main">
                        <?php
                            TrueLib::getTemplatePart('professions-navigation');  
                           
                            if(trim(get_field('page_title', $currentTerm)) != '')
                            {
                                ?>
                                <h2 class="bold-title tc"><?=get_field('page_title', $currentTerm)?></h2>
                                <?php
                            }

                            if(trim(get_field('page_description', $currentTerm)) != '')
                            {
                                ?>
                                <div class='entry-content page-description'>
                                    <?php echo get_field('page_description', $currentTerm)?>    
                                </div>
                                <?php
                            }

                            TrueLib::getTemplatePart('addons-panel'); 

                            TrueLib::getTemplatePart('customers-panel'); 
                        ?>
                    </div><!-- #content -->
                </div><!-- #primary -->
            </div>
        </div>
        <?php       
        return;
    }  


    global $bannerID, $bannerOverrideLine2, $bannerOverrideLine1;
    $bannerID = PROFESSIONS_PAGE_ID;

    $bannerOverrideLine1 = get_field('profession_pages_step_2_line_1', PROFESSIONS_PAGE_ID);
    $bannerOverrideLine2 = get_field('profession_pages_step_2_line_2', PROFESSIONS_PAGE_ID);

    $bannerOverrideLine2 = str_replace('%profession_name%', ucfirst($currentTerm->name), $bannerOverrideLine2);
   
?>
<div class="v1-theme">
    <?php TrueLib::getTemplatePart('page-banner') ?>
    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
        <div id="primary" class="site-content">
            <div id="content" role="main">

            	<?php
            		TrueLib::getTemplatePart('professions-navigation');

                    $stepCount = 3;
                ?>
                <h3 class="section-title"><div class="stepnumber">3</div> coreplus features used by <?=$currentTerm->name?>s</h3>
                <div class="profession-description">
                    <?=get_field('profession_description', $currentTerm)?>
                </div>

                <!-- Available Features -->
                <div class="features">
                    <?php
                        $page_descriptions = array();
                        $tab_contents = array();

                        $tabs = TrueFeatures::getTabsByProfession($currentTerm->term_id);
                        
                        //Tabs
                        if(count($tabs) > 0)
                        {
                            $currentTab = reset($tabs);
                            ?>
                            <div class="tabs-wrapper-container">
                                <div class="tabs-wrapper">
                                    <div class="wrapper">
                                        <div class="list-holder">
                                            <ul class='main-nav-ul'>
                                                
                                                <?php
                                                    global $post;
                                                    $tabCounter = 1;
                                                    foreach($tabs as $post)
                                                    {
                                                        setup_postdata($post); 
                                                        $class = '';
                                                        if($tabCounter == 1)
                                                        {
                                                            $class = 'tight';
                                                        } else if($tabCounter == count($tabs))
                                                        {
                                                            $class = 'tight';
                                                        } else if($tabCounter % 2)
                                                        {
                                                            $class = 'tight';
                                                        }

                                                        if($currentTab->ID == get_the_id())
                                                        {
                                                            $class .= ' active';
                                                        }
                                                        
                                                        ?>
                                                        <li class='main-nav-li <?php echo $class?>' data-feature-id="<?=get_the_id()?>">
                                                            <a><span><?php the_title()?></span></a>
                                                        </li>
                                                        <?php
                                                        $tabCounter++;
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php              
                                //Create the content section!!
                            ?>
                            
                            <div id="primary" class="site-content">
                                <?php
                                    foreach($tabs as $tab)
                                    {
                                        $post = $tab;
                                        setup_postdata($post);  
                                        $layoutType = get_field('layout_type');

                                        ?>
                                        <div class="features-tab features-tab--layout-<?=strtolower($layoutType)?> features-tab-<?=get_the_id()?> <?php if($currentTab->ID == $tab->ID) echo 'active'?>">
                                            <?php
                                                if(trim(get_field('page_description')) != '')
                                                {
                                                    ?>
                                                    <div class='entry-content page-description'>
                                                        <?php echo get_field('page_description')?>    
                                                    </div>
                                                    <?php
                                                }

                                                if(get_field('content')) {
                                                    $contentBlocks = get_field('content');
                                                    $layoutType = get_field('layout_type');
                                                    ?>
                                                    <div class='accordionTab' data-mode="<?=$layoutType?>">
                                                        <div class="features-tab__fixed-wrapper">
                                                            <div class="features-tab__fixed-nav">
                                                                <ul class='resp-tabs-list inner-nav'>
                                                                    <?php
                                                                        $inner_tab_counter = 1;
                                                                        foreach($contentBlocks as $content)
                                                                        {
                                                                            $professions = $content['applicable_professions'];
                                                                            if($professions !== false && $professions != '')
                                                                            {
                                                                                $permitted = false;
                                                                                foreach ($professions as $profession) 
                                                                                {
                                                                                    if($currentTerm->term_id == $profession->term_id)
                                                                                    {
                                                                                        $permitted = true;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }

                                                                            if($permitted) {
                                                                                $itemClass= '';
                                                                                
                                                                                if($inner_tab_counter == 1)
                                                                                {
                                                                                    $itemClass=' resp-tab-active';
                                                                                    $isFirst = false;
                                                                                }
                                                                                
                                                                                ?>
                                                                                <li class="item <?=$itemClass?>">
                                                                                    <?=$content['title']?>
                                                                                </li>
                                                                                <?php
                                                                                $inner_tab_counter++;
                                                                            }
                                                                        }
                                                                    ?>
                                                                </ul>
                                                                <?=TrueLib::createImageTag('right-arrow.png', '', 'features-indicator')?>
                                                                
                                                                <?php if($layoutType == 'ADDON'): ?>
                                                                <img src="<?=TrueLib::getImageUrl("icons/icon_gears.png") ?>" alt="" class="retina-image" />
                                                                <?php endif; ?>
                                                            </div>
                                                            
                                                            &nbsp;
                                                        </div>
                                                        <!-- Tab Content -->
                                                        <div class="resp-tabs-container">
                                                            <?php

                                                                /*Create tab div field for subsection*/
                                                                $inner_tab_counter = 1;
                                                                foreach ($contentBlocks as $content) 
                                                                {
                                                                    $professions = $content['applicable_professions'];
                                                                    if($professions !== false && $professions != '')
                                                                    {
                                                                        $permitted = false;
                                                                        foreach ($professions as $profession) 
                                                                        {
                                                                            if($currentTerm->term_id == $profession->term_id)
                                                                            {
                                                                                $permitted = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }

                                                                    if($permitted) {
                                                                        $layout_class = $content['layout'];
                                                                        $selected = '';
                                                                        if($inner_tab_counter == 1 || $layoutType == 'ADDON')
                                                                        {
                                                                            $selected = ' resp-tab-content-active';
                                                                        }
                                                                        ?>
                                                                        <div class='<?php echo $selected?>' data-location='inner_tab' data-current-tab='false'>
                                                                            <?php if($layoutType == 'ADDON'): ?>
                                                                            <h3 class="features-tab__section-heading">
                                                                                <?=$content['title']?>
                                                                            </h3>
                                                                            <?php endif; ?>
                                                                            <?php
                                                                                $repeater_extender_counter = 1;
                                                                                $sections = $content['sections'];
                                                                                foreach ($sections as $section) 
                                                                                {
                                                                                    ?>
                                                                                    <div class="features-section">
                                                                                        <?php if($content['layout'] == "image-ext"): ?>
                                                                                            <?=view('features/image-extended', ['section' => $section]) ?>
                                                                                        <?php elseif($content['layout'] == "image-left"): ?>
                                                                                            <?=view('features/image-left', ['section' => $section]) ?>
                                                                                        <?php elseif($content['layout'] == "image-rhs"): ?>
                                                                                            <?=view('features/image-right', ['section' => $section]) ?>
                                                                                        <?php elseif($content['layout'] == "image-bottom"): ?>
                                                                                            <?=view('features/image-bottom', ['section' => $section]) ?>
                                                                                        <?php endif; ?>
                                                                                        <div class="clear"></div>
                                                                                    </div>
                                                                                    <?php
                                                                                    $repeater_extender_counter++;
                                                                            
                                                                                }   
                                                                            ?>
                                                                        </div><!-- end tab field -->
                                                                        <?php
                                                                        $inner_tab_counter++;
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <?php 
                                    }
                                ?>
                            </div>
                            
                            <?php
                            
                            wp_reset_postdata();
                            
                        }
                    ?>
                </div>

                <?php
                    TrueLib::getTemplatePart('addons-panel'); 

                    TrueLib::getTemplatePart('customers-panel'); 

                    $attributes = "";                   
                    $customURL = get_term_link($currentTerm);
                    $customTitle = esc_attr($currentTerm->name);
                    if($customURL != '')
                    {
                        $attributes = 'addthis:url="' . $customURL . '" ';
                        $attributes .= ' addthis:counturl="' . $customURL . '" ';
                    }
                    
                     if($customTitle != '')
                    {
                        $attributes .= 'addthis:title="' . $customTitle .'"';
                    }
            
                ?>
                <div class="profession-share">
                    <!-- AddThis Button BEGIN addthis_32x32_style -->
                    <div class="share-label">
                        Share on: 
                    </div>
                    <div class="addthis_toolbox addthis_default_style"  <?=$attributes?>>
                        <a class="addthis_button_google_plusone_share"><img alt="Google Plus Social Icon" class="retina-icon" src="<?=TrueLib::getImageUrl('social/google.png');?>"></a>
                        <a class="addthis_button_facebook"><img alt="Facebook Social Icon" class="retina-icon" src="<?=TrueLib::getImageUrl('social/fb.png');?>"></a>
                        <a class="addthis_button_linkedin"><img alt="LinkedIn Social Icon" class="retina-icon" src="<?=TrueLib::getImageUrl('social/linkedin.png');?>"></a>
                        <a class="addthis_button_twitter"><img alt="Twitter Social Icon" class="retina-icon" src="<?=TrueLib::getImageUrl('social/twitter.png');?>"></a>
                        <a class="addthis_counter addthis_bubble_style"></a>
                    </div>

                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52f19aae01683f3e"></script>
                    <!-- AddThis Button END -->
                </div>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>