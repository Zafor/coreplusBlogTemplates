
<?php if (get_field('associates', 'options')): ?>
 <div class="site-footer__slider associates-footer">
    <?php while (has_sub_field('associates', 'options')):
        $linkStart = '';
        $linkEnd = '';
        if (trim(get_sub_field('site_url')) != ''):
            $linkStart = '<a href="' . trim(get_sub_field('site_url')) . '" target="_blank">';
            $linkEnd = '</a>';
        endif;
        $associate = get_sub_field('logo');
        ?>
        <div>
            <?=$linkStart ?>
            <?= make_image($associate, 'large', ['lazy']) ?>
            <?=$linkEnd ?>
        </div>
    <?php endwhile; ?>
</div>
<?php endif; ?>
