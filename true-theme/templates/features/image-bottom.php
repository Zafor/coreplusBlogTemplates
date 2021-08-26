<div class="entry-content image-on-bottom">
    <?=$section['content']?>
    <?php
        $image = $section['section_image'];
        if ($image): ?>
        <div class="image-box">
            <?= make_image($image, 'full', ['lazy']) ?>
        </div>
    <?php endif; ?>
</div>
