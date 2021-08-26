<?php
    if (!$cta) {
        return;
    }

    $heading = TrueLib::arrayGet($cta, 'heading');
    $linkUrl = TrueLib::arrayGet($cta, 'link.url');
    $linkText = TrueLib::arrayGet($cta, 'link.title');
?>

<div class="wrapper">
    <?php if (!empty($heading) || !empty($linkText)): ?>
    <div class="cta-banner__wrap">
        <a href="<?= $linkUrl ?>" class="cta-banner__link">
            <div class="cta-banner">
                <?php if (!empty($heading)): ?>
                    <div class="cta-banner__heading"><?= $heading ?></div>
                <?php endif; ?>
                <?php if (!empty($linkText)): ?>
                    <div class="cta-banner__btn">
                        <button class="btn btn--colour-red"><?= $linkText ?></button>
                    </div>
                <?php endif; ?>
            </div>
        </a>
    </div>
    <?php else: ?>
        <div class="cta-banner__spacer"></div>
    <?php endif; ?>
</div>