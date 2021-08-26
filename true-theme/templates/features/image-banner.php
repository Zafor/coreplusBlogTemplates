<?php
    if (!get_field('show_opening_banner')):
        return;
    endif;

    $imageUrl = '';
    $image = get_field('banner_right_image');
    if ($image):
        $imageUrl = $image['url'];
    endif;
?>
<div class="feature-banner lazy lazy--bg"
    data-bg="<?=$imageUrl?>">
    <div class="container">
        <div class="layout-block__two-col">
            <div class="layout-block__two-col-cell">
                <h2>
                    <?=get_field('opening_banner') ?>
                </h2>
            </div>
            <div class="layout-block__two-col-cell hidden-xs">
                &nbsp;
            </div>
        </div>
    </div>
</div>
