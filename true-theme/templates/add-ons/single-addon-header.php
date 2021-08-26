<?php
    $logoUrl = TrueLib::arrayGet($logo, 'url');
?>

<div class="wrapper">
    <div class="single-addon-header">
        <div class="single-addon-header__logo">
            <?= make_image($logo, 'full', ['lazy']) ?>
        </div>
        <div class="single-addon-header__content">
            <div class="single-addon-header__heading">
                <span><?= $heading ?></span>
                <?php foreach ($terms as $term): ?>
                    <?php
                        $termUrl = get_term_link($term, 'true_category_tax');
                        $termName = $term->name;
                    ?>
                    <a href="<?= $termUrl ?>"
                        class="category-tag large"
                    >
                        <?= $termName ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="single-addon-header__sub-heading">
                <?= $subHeading ?>
            </div>
            <div class="single-addon-header__main">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
