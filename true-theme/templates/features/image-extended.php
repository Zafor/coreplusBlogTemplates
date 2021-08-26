<div class="image-ext">
    <div class="extended-content-image">
        <?php
        $image = $section['section_image'];
        if($image){
        ?><img alt="<?=$image['alt']?>" src="<?=$image['url']?>"><?php } ?>
    </div>
    <div class="extended-content">
        <h3 class="section-title"><?=$section['section_title']?></h3>
        <div class="entry-content">
            <?=$section['content']?>
        </div>
    </div>
    <div class="clear"></div>
</div>