<?php
    $data = new \Illuminate\Support\Fluent($panel);
?>
<div class="story-block">
    <div class="layout-block layout-block--padded layout-block--colour-white layout-block--left-pattern">
        <div class="container">
            <h2 class="type--colour-dark type--bold layout-block__title">
                <?= $data->stories_title ?>
            </h2>

            <?php
                $leftColType = $data->story_left_content_type;
            ?>
            <div class="story-block__cols">
                <?php if ($leftColType != 'NONE'): ?>
                    <div class="layout-block__two-col">
                        <div class="layout-block__two-col-cell">
                            <?php
                                if ($leftColType == 'VIDEO'):
                                ?>
                                <a class="video-player popup-youtube" href="<?=$data->story_video?>" target="_blank">
                                <?php
                                endif;

                                    $image = $data->story_left_image;

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
                            if (!empty($data->stories_content_title)):
                                ?>
                                <h3 class="type--colour-teal type--bold"><?=$data->stories_content_title?></h3>
                                <?php
                            endif;
                        ?>

                        <?=$data->story_description ?>

                        <?php if ($data->stories_show_button):
                                $button = $data->story_button;
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
