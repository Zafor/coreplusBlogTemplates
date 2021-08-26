<?php
    $blocks = $panel['blocks'];

    if (empty($blocks)):
        return;
    endif;
?>

<div class="image-text-blocks">
    <?php
        $imageSide = 'RIGHT';
    ?>
    <?php foreach ($blocks as $block): ?>
    <div class="layout-block layout-block--padded layout-block--border-top-grey layout-block--colour-<?=strtolower($block['bg_colour'])?>">
        <div class="container">
            <div class="image-text-block image-text-block--side-<?=strtolower($imageSide)?>">
                <!-- Image Cell -->
                <div class="image-text-block__cell image-text-block__image <?php if ($imageSide !== 'LEFT') {
        echo 'image-text-block__image--hidden';
    }?>">
                    <?= make_image($block['image'], 'half-width', ['img-responsive lazy']) ?>
                </div>
                <!-- Text Cell -->
                <div class="image-text-block__cell image-text-block__text">
                    <?=$block['text']?>
                </div>
                <!-- Image Cell -->
                <div class="image-text-block__cell image-text-block__image <?php if ($imageSide !== 'RIGHT') {
        echo 'image-text-block__image--hidden';
    }?>">
                    <?= make_image($block['image'], 'half-width', ['img-responsive lazy']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        if ($imageSide == 'LEFT'):
            $imageSide = 'RIGHT';
        else:
            $imageSide = 'LEFT';
        endif;
    ?>
    <?php endforeach;?>
</div>
