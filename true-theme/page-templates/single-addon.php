<?php
    $pageId = get_the_ID();
    $archivePageId = get_field('add-on_archive_page', 'options');
    $terms = get_the_terms($pageId, 'true_category_tax');
    // $backLinkUrl = get_term_link($terms[0], 'true_category_tax');
    $backLinkUrl = get_permalink($archivePageId);
?>

<div class="layout-block--colour-white">
    <div class="v1-theme v1-theme--no-padding">
        <div class="features">
            <?= view('add-ons/page-banner', [
                'line1'     => get_field('banner_line_1', $archivePageId),
                'line2'     => get_field('banner_line_2', $archivePageId),
                'line3'     => get_field('banner_line_3', $archivePageId),
                'bgColor'   => get_field('background_color', $archivePageId),
                'textColor' => get_field('text_color', $archivePageId)
            ]) ?>

            <div class="wrapper">
                <div class="single-addon-page__back">
                    <a href="<?= $backLinkUrl ?>">
                        <img src="<?=TrueLib::getImageURL('left-nav.svg')?>" alt="">
                        <span>ADD-ONS</span>
                    </a>
                </div>
            </div>

            <?= view('add-ons/single-addon-header', [
                'logo'       => get_field('logo'),
                'heading'    => get_field('header_heading'),
                'terms'      => $terms,
                'subHeading' => get_field('header_sub_heading'),
                'content'    => get_field('header_main_content'),
            ]) ?>

            <div class="flex-content-wrap">
                <?= view('add-ons/flex-content', [
                    'entries' => get_field('flex_content')
                ]) ?>
            </div>

            <?= view('add-ons/bottom-cta', [
                'cta' => get_field('bottom_cta')
            ]) ?>
        </div>
    </div>
</div>