<div class="callout-block">
    <div class="layout-block layout-block--colour-black layout-block--padded">
        <div class="container">
            <?php
                $hasImage = false;
                $colSize = '12 text-center';
                $image = get_field('callout_right_image', $sourceID);

                if ($image) {
                    $colSize = '6 col-sm-pull-6';
                    $hasImage = true;
                }
            ?>

            <div class="row">
                <?php if ($hasImage): ?>
                <div class="col-sm-push-6 col-sm-6">
                    <div class="callout-block__right">
                        <?= make_image($image, 'half-width', ['lazy']) ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-sm-<?=$colSize?>">
                    <div class="callout-block__left">
                        <h2 class="type--colour-white"><?=do_shortcode(get_field('callout_description', $sourceID))?></h2>

                        <?php if (get_field('callout_show_button', $sourceID)): ?>
                            <div class="callout-block__button">
                                <?php
                                    $button = get_field('callout_button', $sourceID);
                                ?>
                                <a class="btn btn--colour-orange" href="<?=$button['url']?>"><?=$button['title']?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
