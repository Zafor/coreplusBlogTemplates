<!-- Coreplus Overview -->

<?php
    $tabs = get_field('overview_tabs', $sourceID);
    
    $overlayClass = '';
    if(count($tabs) > 0):
        $overlayClass = $tabs[0]['tab_colour'];
    endif;
?>

<div class="overview-block overview-block--colour-<?=strtolower($overlayClass)?>" data-control="overview-blocks">
    <!-- Nav -->
    <div class="overview-block__nav-container">
        <div class="overview-block__nav">
            <div class="container">
                <div class="overview-block__mobile-nav">
                    <div class="overview-block__mobile-nav-header visible-xs">
                        Select a Feature <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </div>
                    <ul class="nav nav-tabs">
                        <?php
                            $tabCount = 1;
                            $width = 100 / (count($tabs))
                        ?>
                        <?php foreach($tabs as $tab): ?>
                            <?php
                                if(is_array($tab['tab_colour'])):
                                    $tab['tab_colour'] = '';
                                endif;
                                $overlayClass = strtolower($tab['tab_colour']);
                            ?>
                            <li role="presentation" class="<?php if($tabCount == 1) echo 'active'?>" data-colour="<?=$overlayClass?>">
                                <a data-target="overviewTab<?=$tabCount?>"><span><?=$tab['tab_title']?></span></a>
                            </li>
                            <?php
                                $tabCount++;
                            ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabs -->
    <div class="overview-block__tabs">
        <div class="tab-content">
            <?php
                $tabCount = 1;
            ?>
            <?php foreach($tabs as $tab): ?>

                <?php
                    $class = 'overview-block__tab';

                    if($tabCount == 1):
                        $class .= ' active';
                    endif;

                    if(is_array($tab['tab_colour'])):
                        $tab['tab_colour'] = '';
                    endif;
                    $overlayClass = strtolower($tab['tab_colour']);
                    
                    $animatedBG = '';
                    if($tab['animated_bg_image']):
                        $animatedBG = $tab['animated_bg_image']['sizes']['full-width'];
                    endif;
                ?> 
                <!-- Tab -->
                <div role="tabpanel" class="<?=$class?>" <?php if($tabCount != 1) { echo 'style="display: none"'; } ?> id="overviewTab<?=$tabCount?>">
                    
                    <div class="overview-block-item overview-block-item--colour-<?=$overlayClass?>">
                        <!-- Banner -->
                        <div class="overview-block-item__banner banner--fixed banner banner--small" style="background-image: url('<?=$tab['banner_image']['sizes']['full-width']?>')">
                            <div class="banner__content" data-bg="<?=$animatedBG?>">
                                <div class="layout-table">
                                    <div class="layout-table__cell">
                                        <div class="container">
                                            <h2>
                                                <?php if($tab['banner_icon'] != 'NONE'): ?>
                                                <div class="overview-block-item__icon hidden-sm hidden-xs">
                                                    <i class="moon-icon--<?=$tab['banner_icon']?>"></i>
                                                </div>
                                                <?php endif; ?>
                                                <?=do_shortcode($tab['banner_title'])?>
                                                <?php if($tab['banner_icon'] != 'NONE'): ?>
                                                <div class="overview-block-item__icon visible-sm-inline-block visible-xs-inline-block">
                                                    <i class="moon-icon--<?=$tab['banner_icon']?>"></i>
                                                </div>
                                                <?php endif; ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php if(is_array($tab['features']) && count($tab['features']) > 0): ?>
                        <!-- Features -->
                        <div class="overview-block-item__features">
                            <div class="layout-block layout-block--padded-semi-medium layout-block--padding-bottom layout-block--colour-grey">
                                <div class="container">
                                    <div class="row">
                                        <?php foreach($tab['features'] as $feature): ?>
                                        <div class="col-sm-4">
                                            <div>
                                                <h3 class="type--bold"><?=$feature['feature_title']?></h3>
                                            </div>
                                            <div>
                                                <?=$feature['feature_description']?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                    $tabCount++;
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>