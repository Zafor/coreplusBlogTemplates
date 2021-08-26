<?php
    $bgImage = get_field('banner_background', $sourceID);
    $bgUrl = '';
    if ($bgImage) {
        $bgUrl = $bgImage['sizes']['full-width'];
    }
?>
<div class="banner banner--standard banner--home lazy lazy--bg"
    data-bg="<?=$bgUrl?>">
    <div class="banner__content">
        <?php
                $colSize = 12;
                $hasBanner = false;
                $class = 'text-center';
                if (get_field('banner_right_image', $sourceID)):
                    $colSize = 6;
                    $class = '';
                    $hasBanner = true;
                endif;
            ?>
        <div class="banner__col-wrapper-outer">
            <div class="banner__col-wrapper  <?php if (!$hasBanner) {
                echo 'banner__col-wrapper--full';
            }?> layout-table">
                <div class="banner__col <?php if (!$hasBanner) {
                echo 'banner__col--full';
            }?> layout-table__cell">
                    <div class="banner__col-inner">
                        <h1 class="type--colour-orange"><?=do_shortcode(get_field('banner_content', $sourceID))?></h1>

                        <?php if (get_field('show_banner_button', $sourceID)): ?>
                            <div class="banner__button">
                                <?php
                                    $url = get_field('banner_button_url', $sourceID);
                                    $buttonClass = '';
                                    if (get_field('banner_button_type', $sourceID) == 'VIDEO'):
                                        $buttonClass = ' popup-youtube';
                                    endif;
                                ?>

                                <a class="btn btn--colour-orange<?=$buttonClass?>" href="<?=$url?>" <?php if (get_field('banner_button_type', $sourceID) == 'VIDEO') {
                                    echo 'target="_blank"';
                                } ?>>
                                    <?php if (get_field('banner_button_type', $sourceID) == 'VIDEO'): ?>
                                    <i class="moon-icon--play moon-icon--space-right"></i>
                                    <?php endif ?>

                                    <?=get_field('banner_button_text', $sourceID) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($hasBanner): ?>
                <div class="banner__col hidden-xs layout-table__cell text-center">
                    <?php
                        $banner = get_field('banner_right_image', $sourceID);
                    ?>
                    <?= make_image($banner, 'half-width', ['img-responsive lazy']) ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
