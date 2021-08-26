<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

/**
 * @param array $panel
 * - type 'static'|'video'
 * - bg_image
 * - banner_image
 * - heading
 * - description
 * - link
 * - video_link - Optional, if type is 'video'
 */
$panel = new Fluent($panel);
?>
<section class="tw-relative tw-py-32 tw-border-solid tw-border-0 tw-border-b tw-border-gray-300">
    <div class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0">
        <?= make_image($panel->bg_image, 'full', ['tw-absolute tw-w-full tw-h-full lazy tw-object-cover tw-object-center']) ?>
    </div>
    <div class="container tw-relative tw-z-10">
        <div class="tw-flex tw-flex-wrap md:tw-flex-no-wrap tw-w-full tw-justify-between tw-items-center">
            <div class=" tw-max-w-2xl tw-mx-auto md:tw-mx-0 md:tw-max-w-4xl tw-order-2 md:tw-order-1 tw-w-full md:tw-w-1/2 tw-text-center md:tw-text-left">
                <h1 class="tw-text-primary"><?= $panel->heading ?></h1>
                <?php if ($panel->description): ?>
                <p>
                    <?= $panel->description ?>
                </p>
                <?php endif; ?>
                <?php if ($panel->link): ?>
                <div class="tw-pt-8">
                <?= View::make('partials/simple-link', [
                    'link' => $panel->link,
                    'css' => 'btn btn--colour-orange'
                ]) ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="tw-w-full md:tw-w-1/2 tw-order-1 md:tw-order-2">
                <div class="tw-max-w-lg md:tw-max-w-full tw-mx-auto tw-mb-8 md:tw-mb-0">
                    <?php if ($panel->type === 'video'): ?>
                    <div class="tw-block tw-relative">
                        <?= make_image($panel->banner_image, 'full', ['lazy img-responsive']) ?>
                        <a href="<?= $panel->video_link ?>"
                            class="video-link tw-cursor-pointer tw-absolute tw-top-0 tw-left-0 tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center">
                            <div class="tw-w-32 tw-h-32 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-relative has-pulse tw-group">
                                <div class="tw-absolute tw-rounded-full tw-inset-0 tw-bg-white tw-bg-opacity-25 group-hover:tw-bg-primary tw-transform tw-transition tw-duration-75 tw-ease-in group-hover:tw-scale-100 tw-scale-100"></div>
                                <div class="tw-absolute tw-rounded-full tw-inset-0 tw-bg-white tw-bg-opacity-50 group-hover:tw-bg-primary tw-transform tw-transition tw-duration-75 tw-ease-in group-hover:tw-scale-100 tw-scale-85"></div>
                                <div class="tw-absolute tw-rounded-full tw-inset-0 tw-bg-white tw-bg-opacity-75 group-hover:tw-bg-primary tw-transform tw-transition tw-duration-75 tw-ease-in group-hover:tw-scale-100 tw-scale-70"></div>
                                <svg
                                    aria-hidden="true"
                                    focusable="false"
                                    data-icon="play"
                                    class="tw-relative tw-w-12 tw-h-12 tw-text-gray-800 group-hover:tw-text-white"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <?php else: ?>
                    <?= make_image($panel->banner_image, 'full', ['lazy img-responsive']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
