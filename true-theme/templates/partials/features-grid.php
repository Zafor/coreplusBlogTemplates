<?php 
    $rowOpened = false;
    $colNo = 0;
?>
<?php foreach($features as $feature): ?>
    <?php 
        if(!$rowOpened):
            $rowOpened = true;
        ?>
        <div class="row">
    <?php endif; ?>
    
    <div class="col-sm-4">
        <div class="feature-block-item">
            <div class="feature-block-item__content">
                <h3 class="type--colour-pink type--bold">
                    <?=$feature['feature_title']?>
                </h3>

                <div class="feature-block-item__description">
                    <?=$feature['feature_description']?>
                </div>
            </div>
            
            <?php if(is_array($feature['buttons']) && count($feature['buttons']) > 0): ?>
                <ul class="feature-block-item__buttons">
                    <?php foreach($feature['buttons'] as $buttonRow): ?>
                        <?php
                            $button = $buttonRow['link'];
                        ?>
                        <li class="button-no-<?=$buttonNo?>">
                            <a class="btn btn--invisible-black" href="<?=$button['url']
                            ?>"><?=$button['title']?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <?php
        $colNo++;

        if($colNo == 3):
            $rowOpened = false;
            echo '</div>';
        endif;
    ?>
<?php endforeach; ?>


<?php if($rowOpened): ?>
    </div>
<?php endif; ?>