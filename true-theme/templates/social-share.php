<?php 
    $settings = TrueShare::getShareSettings();
    extract($settings);
 ?>

<div class="share clearfix">
    <div class="share-label">
        Share this
    </div>
    <div class="share-container">
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style<?=$sizeCode?>" <?=$attributes?>>
            <?php foreach ($services as $service): ?>
                <?= $service ?>
            <?php endforeach ?>
        </div>
    </div>
</div><!-- Share -->