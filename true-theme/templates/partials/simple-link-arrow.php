<?php
/**
 * @param $link ACF link object
 * @param $css  Additional CSS classes to append
 * @param $arrowCss  Additional CSS classes to append to arrow icon
 * @param $attrs  Additional attributes
 **/

use Illuminate\Support\Arr;

if (!isset($attrs)) {
    $attrs = [];
}
if (!isset($arrowCss)) {
    $arrowCss = '';
}
?>
<a href="<?= Arr::get($link, 'url') ?>"
    <?php if ($target = Arr::get($link, 'target')): ?>
    target="<?= $target ?>"
    <?php endif ?>
    <?php foreach ($attrs as $attrKey => $value): ?>
    <?= $attrKey ?>="<?= $value ?>"
    <?php endforeach ?>
    class="<?= $css ?>">
    <?= Arr::get($link, 'title') ?>
    <svg class="<?= $arrowCss ?>" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.16 -0.000121517L7.4832 0.760053L10.1616 3.7738L-1.88833e-07 3.7738L-1.4687e-07 4.85206L10.1616 4.85206L7.4784 7.86041L8.16 8.62598L12 4.31293L8.16 -0.000121517Z" fill="#F8A94C"/>
    </svg>
</a>
