<?php
    $categories = TrueAddonV2::getCategories();
    if (!$categories || count($categories) < 1) {
        return;
    }

    $activeTerm = isset($activeTerm) ? $activeTerm : '';

    $archivePageId = get_field('add-on_archive_page', 'options');
    $backLinkUrl = get_permalink($archivePageId);
?>

<div class="category-filter">
    <?php foreach ($categories as $category): ?>
        <?php
            $termId   = $category->term_id;
            $termName = $category->name;
            $termSlug = $category->slug;
            $termUrl  = get_term_link($category, 'true_category_tax');
        ?>
        
        <a class="category-filter__item <?= $activeTerm == $termSlug ? 'active' : '' ?>" 
            href="javascript:;" 
            data-back-url="<?= $backLinkUrl ?>" 
            data-term-url="<?= $termUrl ?>"
            data-post-filter-item="<?= $termSlug ?>"
        >
            <?= $termName ?>
        </a>
    <?php endforeach; ?>
</div>