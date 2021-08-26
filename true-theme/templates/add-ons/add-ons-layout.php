<?php

?>

<div class="add-ons-layout__outer">
    <div class="wrapper" data-sticky-container>
        <div class="add-ons-layout">
            <div class="add-ons-layout__left" data-sticky>
                <?= view('add-ons/category-filter') ?>
            </div>
            <div class="add-ons-layout__right">
                <?= view('add-ons/add-on-list-header', [
                    'heading'       => get_field('heading'),
                    'cardHeading'   => get_field('featured_card_heading'),
                    'featuredAddOn' => get_field('featured_add-on'),
                    'usingImage'    => get_field('using_image_background'),
                    'cardBgColor'   => get_field('card_bg_color'),
                    'useBgImage'    => get_field('using_image_background'),
                    'cardBgImage'   => get_field('card_bg_image'),
                ]) ?>
                <?= view('add-ons/add-on-list', [
                    'slug' => 'all'
                ]) ?>
            </div>
        </div>
    </div>
</div>