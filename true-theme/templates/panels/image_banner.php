<?php
$bgUrl = \Illuminate\Support\Arr::get($panel, 'background_image.sizes.full-width');
$bgUrlMobile = \Illuminate\Support\Arr::get($panel, 'mobile_banner_image.sizes.full-width');
$hasMobile = false;
if ($bgUrlMobile) {
    $hasMobile = true;
}
?>
<div class="image-banner tw-relative"
    >
    <div class="image-banner__bg tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0">
        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-object-cover lazy <?= $hasMobile ? 'tw-hidden md:tw-block' : '' ?>"
            data-src="<?=$bgUrl?>">
        <?php if ($hasMobile): ?>
        <img class="tw-block md:tw-hidden tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-object-cover lazy"
            data-src="<?=$bgUrlMobile?>">
        <?php endif; ?>
    </div>
    <!-- Top Banner -->
    <div class="image-banner__top tw-relative">
        <div class="row">
            <div class="col-sm-12">
                <div class="v1-theme">

                    <div class="top-banner">
                        <div class="container">

                            <div class="site-content">
                                <?php
                                    if (!empty($panel['banner_line_1'])): ?>
                                        <h2><?=do_shortcode($panel['banner_line_1'])?></h2>
                                        <?php
                                    endif;

                                    if (!empty($panel['banner_line_2'])): ?>
                                        <h1><?=do_shortcode($panel['banner_line_2'])?></h1>
                                        <?php
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <?php createTrueBreadcrumb()?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Banner -->
    <div class="layout-table tw-relative">
        <div class="layout-table__cell layout-table__cell--align-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="image-banner__text">
                            <?=$panel['opening_text'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
