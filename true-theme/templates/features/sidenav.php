<div class="features-tab__fixed-wrapper">
    <div class="features-tab__fixed-nav">
        <ul class='resp-tabs-list inner-nav'>
            <?php
                $inner_tab_counter = 1;
                foreach ($contentBlocks as $content):
                    $itemClass = '';

                    if ($inner_tab_counter == 1):
                        $itemClass = ' resp-tab-active';
                        $isFirst = false;
                    endif;

                    ?>
                    <li class="item <?=$itemClass?>">
                        <?=$content['title']?>
                    </li>
                    <?php
                    $inner_tab_counter++;
                endforeach;
            ?>
        </ul>
        <?=TrueLib::createImageTag('right-arrow.png', '', 'features-indicator')?>
        <?php if ($layoutType == 'ADDON' && !empty($footerNavLink)): ?>
        <div class="features-tab__fixed-nav-footer">
            <a href="<?=$footerNavLink['url']?>">
                <img src="<?=TrueLib::getImageUrl('icons/icon_gears.png') ?>" alt="" class="retina-image" />
                <?=$footerNavLink['title'] ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
    &nbsp;
</div>