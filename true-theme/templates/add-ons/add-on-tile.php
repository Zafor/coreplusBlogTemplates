<?php
    $postId = $post->ID;
    $heading = $post->post_title;
    $shortDescriptioin = get_field('short_description', $postId);
    $linkUrl = get_permalink($post);

    $logo = get_field('logo', $postId);
    $logoUrl = TrueLib::arrayGet($logo, 'url');

    $terms = get_the_terms($postId, 'true_category_tax');
?>

<div class="single-add-on-tile">
    <div class="single-add-on-tile__wrap">
        <div class="single-add-on-tile__header">
            <?= make_image($logo, 'full', ['img-responsive lazy']) ?>
            <div class="single-add-on-tile__heading"><?= $heading ?></div>
            <?php foreach ($terms as $term): ?>
                <?php
                    $termUrl = get_term_link($term, 'true_category_tax');
                    $termName = $term->name;
                ?>
                <a href="<?= $termUrl ?>"
                    class="category-tag"
                >
                    <?= $termName ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="single-add-on-tile__description">
            <?= $shortDescriptioin ?>
        </div>
        <div class="single-add-on-tile__bottom">
            <a href="<?= $linkUrl ?>">
                VIEW MORE
            </a>
        </div>
    </div>
</div>
