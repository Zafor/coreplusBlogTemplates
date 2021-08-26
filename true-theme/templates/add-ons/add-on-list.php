<?php
    $args = array(
        'post_type'      => 'true_addon_v2',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'publish_date',
        'order'          => 'DESC'
    );

    if ($slug != 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'true_category_tax',
                'field'    => 'slug',
                'terms'    => $slug
            )
        );
    }

    $objects = get_posts($args);

    $posts = array();
    if (count($objects) > 0) {
        foreach ($objects as $object) {
            $posts[] = $object;
        }
    }
?>

<div class="add-ons-list">
    <div class="row row--flex">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-6">
                <?= view('add-ons/add-on-tile', [
                    'post' => $post
                ]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
