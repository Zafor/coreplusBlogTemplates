<div class="row">
    <div class="col-sm-3">
        <div class="site-footer__block site-footer__nav site-footer__primary-nav">
            <?php
                $defaults = array(
                    'theme_location' => 'footer-primary',
                    'menu' => '',
                    'container' => 'div',
                    'container_class' => '',
                    'container_id' => '',
                    'menu_class' => 'menu',
                    'menu_id' => '',
                    'echo' => true,
                    'fallback_cb' => 'wp_page_menu',
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 1,
                );
                wp_nav_menu($defaults);
            ?>
        </div>

        <?=View::make('footer/social') ?>
        
    </div>
    <div class="col-sm-6">
        <div class="site-footer__block site-footer__nav site-footer__sub-nav">
            
            <div class="row">
                <?php if (($locations = get_nav_menu_locations()) && isset($locations['footer-secondary']) ):

                    $menu = get_term( $locations['footer-secondary'], 'nav_menu' );
                    $menuItems = wp_get_nav_menu_items($menu->term_id);
                    
                    $split = ceil(count($menuItems)/2);

                    ?>
                    <div class="col-sm-6">
                        <ul class="menu">
                            <?php
                                $itemCounter = 0;
                                foreach($menuItems as $item):
                                    
                                    $cssClass = implode(' ', $item->classes);
                                    ?>
                                    <li class="list-item <?=$cssClass?>">
                                        <a href="<?=$item->url?>"><?=$item->title?></a>
                                    </li>
                                    <?php
                                    $itemCounter++;

                                    if($itemCounter == $split):
                                        ?>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="menu">
                                        <?php
                                    endif;
                                endforeach;
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="site-footer__block site-footer-details">
            <?php
                if (get_field('footer_contact_details', 'options')) {
                    while (has_sub_field('footer_contact_details', 'options')):
                        $title = get_sub_field('title');
                        $content = get_sub_field('content');
                        ?>
                        <div class="site-footer-details__block">
                            <h4><?php echo $title ?></h4>
                            <div class="entry-content">
                                <?php echo $content ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                }
            ?>
        </div>
    </div>
</div>