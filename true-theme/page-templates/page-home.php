<?php
    /**
     * Template Name: Home
     *
     */
?>

<div data-control="home-blocks">

<?=View::make('blocks/banner', ['sourceID' => HomeContent::getSectionSource('banner')]) ?>

<?=View::make('blocks/overview', ['sourceID' => HomeContent::getSectionSource('overview')]) ?>

<?=View::make('blocks/features', ['sourceID' => HomeContent::getSectionSource('features')]) ?>

<?=View::make('blocks/plans', ['sourceID' => HomeContent::getSectionSource('plans')]) ?>

<?=View::make('blocks/callout', ['sourceID' => HomeContent::getSectionSource('callout')]) ?>

<?=View::make('blocks/stories', ['sourceID' => HomeContent::getSectionSource('story')]) ?>

</div>

<?php wp_reset_postdata() ?>
