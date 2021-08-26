<?php
    if (!$featuredAddOn) {
        return;
    }


    $bgImageUrl = TrueLib::arrayGet($cardBgImage, 'url');
    $bgImageUrl = $useBgImage ? $bgImageUrl : '';

    $addOn = TrueLib::arrayGet($featuredAddOn, 'add_on.0');
    $logos = TrueLib::arrayGet($featuredAddOn, 'logos');

    $addOnId = $addOn->ID;
    $addOnHeading = $addOn->post_title;
    $shortDescription = get_field('short_description', $addOnId);
    $terms   = get_the_terms($addOnId, 'true_category_tax');
    $linkUrl = get_permalink($addOnId);
?>

<div class="add-on-list-header">
    <div class="add-on-list-header__heading">
        <?= $heading ?>
    </div>
    <div class="add-on-header-card">
        <div class="add-on-header-card__bg" style="background-image:url('<?=$bgImageUrl?>'); background-color: <?= $cardBgColor ?>"></div>
        <a href="<?= $linkUrl ?>" class="add-on-header-card__link">
        <div class="add-on-header-card__wrap">
            <div class="add-on-header-card__header">
                <i class="fa fa-star" aria-hidden="true"></i>
                <span><?= $cardHeading ?></span>
            </div>
            <div class="add-on-header-card__body">
                <div class="add-on-header-card__left">
                    <div class="add-on-header-card__heading"><?= $addOnHeading ?></div>
                    <div class="add-on-header-card__categories">
                        <?php foreach ($terms as $term): ?>
                            <?php
                                $termUrl = get_term_link($term, 'true_category_tax');
                                $termName = $term->name;
                            ?>
                            <span class="category-tag"><?= $termName ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="add-on-header-card__description">
                        <?= $shortDescription ?>
                    </div>
                    <div class="add-on-header-card__btn">
                        <button class="btn btn--colour-solid-orange">
                            Learn More
                        </button>
                    </div>
                </div>
                <div class="add-on-header-card__right">
                    <div class="add-on-header-card__logos">
                        <?php foreach ($logos as $logo): ?>
                            <?php
                                $img = TrueLib::arrayGet($logo, 'logo');
                                $imgUrl = TrueLib::arrayGet($logo, 'logo.url');
                                $bgColour = TrueLib::arrayGet($logo, 'bg_colour');
                            ?>
                            <div class="add-on-header-card__logo-wrap" style="background-color: <?= $bgColour ?>">
                                <div class="add-on-header-card__logo">
                                    <?= make_image($img, 'full', ['img-responsive lazy']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
