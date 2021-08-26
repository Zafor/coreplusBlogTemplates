<div class="story-block">
    <div class="layout-block layout-block--padded  layout-block--colour-white layout-block--left-pattern">
        <div class="container">
            <h2 class="type--colour-dark type--bold layout-block__title">
                <?=get_field('story_title', $sourceID)?>
            </h2>

            <?php
                $leftColType = get_field('story_left_content_type', $sourceID);
            ?>
            <div class="story-block__cols">
                <?php if ($leftColType != 'NONE'): ?>
                    <div class="layout-block__two-col">
                        <div class="layout-block__two-col-cell">
                            <?php
                                if ($leftColType == 'VIDEO'):
                                ?>
                                <a class="video-player popup-youtube" href="<?=get_field('story_video', $sourceID)?>" target="_blank">
                                <?php
                                endif;

                                    $image = get_field('story_left_image', $sourceID);

                                    ?>
                                    <?= make_image($image, 'half-width', ['lazy img-responsive']) ?>
                                    <?php

                                if ($leftColType == 'VIDEO'):
                                ?>
                                </a>
                                <?php
                                endif;
                            ?>
                        </div>
                        <div class="layout-block__two-col-cell">
                <?php else: ?>
                    <div class="text-center">
                <?php endif; ?>
                        <?php
                            if (!empty(get_field('stories_content_title', $sourceID))):
                                ?>
                                <h3 class="type--colour-teal type--bold"><?=get_field('stories_content_title', $sourceID)?></h3>
                                <?php
                            endif;
                        ?>

                        <?=get_field('story_description', $sourceID) ?>

                        <?php if (get_field('stories_show_button', $sourceID)):
                                $button = get_field('story_button', $sourceID);
                                ?>
                                <div class="layout-block__button-spacer">
                                    <a class="btn btn--colour-teal" href="<?=$button['url']?>"><?=$button['title']?></a>
                                </div>
                        <?php endif; ?>

                    <?php if ($leftColType != 'NONE'): ?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
