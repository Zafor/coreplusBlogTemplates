<div class="text-with-logos-banner">
    <div class="wrapper">
        <div class="flex-content-row">
            <div class="flex-content-col">
                <div class="flex-content-heading orange"><?= $heading ?></div>
                <div class="text-with-logos-banner__content">
                    <?= $content ?>
                </div>
            </div>
            <div class="flex-content-col">
                <div class="text-with-logos-banner__logos">
                    <?php foreach ($logos as $logo): ?>
                        <?php
                            $logoUrl = TrueLib::arrayGet($logo, 'logo.url');
                            $bgColour = TrueLib::arrayGet($logo, 'bg_colour');
                        ?>
                        <div class="text-with-logos-banner__logo-wrap" style="background-color: <?= $bgColour ?>">
                            <div class="text-with-logos-banner__logo">
                                <img src="<?= $logoUrl ?>" class="img-responsive" alt="">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>