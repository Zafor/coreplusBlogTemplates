<?php
    $features = get_field('features', $sourceID);
?>

<div class="feature-block">
    <?php if(is_array($features) && count($features) > 0): ?>
        <div class="layout-block layout-block--padded layout-block--colour-white">
            <div class="container">
                <?php
                    $features = get_field('features', $sourceID);
                ?>

                <h2 class="type--colour-dark type--bold layout-block__title">
                    <?=get_field('features_title', $sourceID)?>
                </h2>
                
                <?=View::make('partials/features-grid', ['features' => $features]) ?>
            </div>
        </div>
    <?php endif; ?>
</div>
