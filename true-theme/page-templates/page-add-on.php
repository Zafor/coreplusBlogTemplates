<?php

    /**
     * Template Name: Add On
     *
     */

   
?>

<div class="layout-block--colour-white">
    <div class="v1-theme v1-theme--no-padding">
        <div class="features">
            <?= view('add-ons/page-banner', [
                'line1'     => get_field('banner_line_1'),
                'line2'     => get_field('banner_line_2'),
                'line3'     => get_field('banner_line_3'),
                'bgColor'   => get_field('background_color'),
                'textColor' => get_field('text_color')
            ]) ?>

            <?= view('add-ons/add-ons-layout') ?>

            <?= view('add-ons/bottom-cta', [
                'cta' => get_field('bottom_cta')
            ]) ?>
        </div>
    </div>
</div>