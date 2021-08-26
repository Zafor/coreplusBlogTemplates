<div class="plans-block-item <?php if($isPopular) echo 'plans-block-item--popular' ?>" data-block-no="<?=$blockNo?>">
    <div class="plans-block-item__spacer"></div>

    <div class="plans-block-item__content">
        <div class="layout-table">
            <div class="layout-table__cell">
                <?php if($isPopular): ?>
                    <div class="plans-block-item__popular">
                        Most Popular
                    </div>
                <?php endif; ?>

                <h4 class="plan-block-item__title">
                    <?=$title?>
                </h4>

                <h3 class="type--size-h1 type--medium-bold type--colour-teal plan-block-item__price">
                    <?=$price ?>
                </h3>

                <h4 class="plan-block-item__footer">
                    <?=$footerText?>
                </h4>
            </div>
        </div>
    </div>
</div>