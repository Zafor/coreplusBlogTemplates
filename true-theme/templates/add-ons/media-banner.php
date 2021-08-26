<?php
    $imageUrl = $image ? TrueLib::arrayGet($image, 'url') : '';
    $rowClass = $isReverse ? 'reverse' : '';
?>
<div class="media-banner">
    <div class="wrapper">
        <div class="flex-content-row <?= $rowClass ?>">
            <div class="flex-content-col">
                <div class="flex-content-heading green"><?= $heading ?></div>
                <?php if ($useWysiwyg): ?>
                    <div class="media-banner__content">
                        <?= $wysiwyg ?>
                    </div>
                <?php else: ?>
                    <div class="media-banner__list">
                        <?php foreach ($list as $item): ?>
                            <div class="media-banner__item">
                                <?= TrueLib::arrayGet($item, 'item'); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="flex-content-col">
                <?php if ($enableVideo): ?>
                    <a href="<?= $videoUrl ?>" class="media-banner__link video-link">
                        <div class="media-banner__play-icon-wrap">
                            <div class="media-banner__play-icon">
                                <i class="moon-icon--play"></i>
                            </div>
                        </div>
                        <div class="media-banner__overlay"></div>
                        <div class="media-banner__image lazy lazy--bg"
                            data-bg="<?=$imageUrl?>"></div>
                    </a>
                <?php else: ?>
                    <div class="media-banner__image-wrap">
                        <div class="media-banner__image lazy lazy--bg"
                            data-bg="<?=$imageUrl?>"></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
