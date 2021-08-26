<div class="action-banner">
    <div class="wrapper">
        <div class="action-banner__wrap">
            <div class="flex-content-heading white"><?= $heading ?></div>
            <div class="action-banner__tiles">
                <?php foreach ($actions as $action): ?>
                    <?php
                        $icon    = TrueLib::arrayGet($action, 'action.icon');
                        $url     = TrueLib::arrayGet($action, 'action.link.url');
                        $heading = TrueLib::arrayGet($action, 'action.heading');
                        $content = TrueLib::arrayGet($action, 'action.content');
                    ?>
                    <a href="<?= $url ?>" class="action-banner__tile">
                        <div class="action-banner__tile-wrap">
                            <div class="action-banner__icon">
                                <img src="<?=TrueLib::getImageURL($icon)?>" alt="">
                            </div>
                            <div class="action-banner__heading"><?= $heading ?></div>
                            <div class="action-banner__content"><?= $content ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>