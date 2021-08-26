<div class="plans-block" data-control="plans-block">
    <div class="layout-block layout-block--padded layout-block--colour-teal">
        <div class="container">
            <h2 class="type--block-title type--block-margin layout-block__title"><?=get_field('plans_title', $sourceID)?></h2>
            
            <div class="row">
                <?php
                    $packages = get_field('packages', 5422);

                    $blockNo = 1;
                    foreach($packages as $plan):
                        ?>
                        <div class="col-md-3">
                            <?=View::make('blocks/plans/plan-item', [
                                'title' => $plan['package_name'], 
                                'isPopular' => $plan['is_most_popular'],
                                'price' => $plan['package_price'],
                                'footerText' => $plan['package_price_per_qty'],
                                'blockNo' => $blockNo
                            ]) ?>
                        </div>
                        <?php

                        $blockNo++;
                    endforeach;

                    //Lower button
                    $button = get_field('pricing_button', $sourceID);
                ?> 
            </div>
        
            <?php
                if($button): ?>
                    <div class="plans-block__footer">
                        <a href="<?=$button['url']?>" class="btn btn--colour-white-teal"><?=$button['title']?></a>
                    </div>
                    <?php
                endif;
            ?>
        </div>
    </div>
</div>