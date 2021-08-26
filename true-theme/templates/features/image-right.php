<div class="entry-content image-rhs">
    <?=$section['content']?>
</div>
<div class="image-on-right">
    <?php
        $image = $section['section_image'];
        if($image): ?>
            <div class="image-box"><img class="image-box" alt="<?=$image['alt']?>" src="<?=$image['url']?>"></div>
        <?php endif; ?>
</div>