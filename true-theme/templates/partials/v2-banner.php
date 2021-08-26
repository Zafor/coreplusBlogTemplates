<?php
    $bgUrl = '';
    if(!empty($bgImage)):
        $bgUrl = $bgImage['sizes']['home-banner'];
    endif;
    
    if(!isset($class)):
        $class = '';
    endif;
?>
<div class="core-banner <?=$class ?>" style="background-image: url('<?=$bgUrl?>')">
    <div class="core-banner__overlay">
        <div class="container">
            <div class="core-banner__content">
                <!-- Image -->
                <div class="core-banner__cell core-banner__product-image">
                    <img class="img-responsive" src="<?=$leftImage['url']?>" alt="<?=esc_attr($leftImage['alt'])?>" />
                </div>

                <!-- Text -->
                <div class="core-banner__cell">
                    <?php if(!empty($line1)): ?>
                    <h1><?=$line1?></h1>
                    <?php endif; ?>

                    <?php if(!empty($line2)): ?>
                    <p><?=$line2?></p>
                    <?php endif; ?>

                    <?php if($showButton): ?>
                    <div class="core-banner__button">
                        <a class="btn btn--size-medium btn--colour-pink" href="<?=$button['url']?>">
                            <?=$button['title']?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>