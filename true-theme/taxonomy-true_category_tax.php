<?php
    $queriedObj = get_queried_object();
    $activeSlug = $queriedObj->slug;
    $archivePageId = get_field('add-on_archive_page', 'options');
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

            <div class="add-ons-layout__outer">
                <div class="wrapper" data-sticky-container>
                    <div class="add-ons-layout">
                        <div class="add-ons-layout__left" data-sticky>
                            <?= view('add-ons/category-filter', [
                                'activeTerm' => $activeSlug
                            ]) ?>
                        </div>
                        <div class="add-ons-layout__right">
                        <?= view('add-ons/add-on-list', [
                            'slug' => $activeSlug
                        ]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <?= view('add-ons/bottom-cta', [
                'cta' => get_field('bottom_cta', $archivePageId)
            ]) ?>
        </div>
    </div>
</div>