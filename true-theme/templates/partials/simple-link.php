<?php
/**
 * @param $link ACF link object
 * @param $css  Additional CSS classes to append
 * @param $attrs  Additional attributes
 **/

use Illuminate\Support\Arr;

if (!isset($attrs)) {
    $attrs = [];
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
</a>
