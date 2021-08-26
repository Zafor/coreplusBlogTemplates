<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

/**
 * @param array $panel
 * - heading
 * - link
 * - image
 * - list_items
 *   - heading
 *   - image
 *   - description
 *   - link
 */
$panel = new Fluent($panel);
?>
<section class="tw-relative tw-pt-32">
    <div class="container">
        <div class="tw-text-center tw-pb-12">
            <?php if ($panel->heading): ?>
            <h3 class="tw-text-primary">
                <?= $panel->heading ?>
            </h3>
            <?php endif; ?>
        </div>
        <div class="tw-flex tw-flex-wrap tw-relative tw-items-center tw-justify-between">
            <div class="tw-w-full md:tw-w-1/2 tw-z-10 tw-relative tw-order-2 md:tw-order-1">
                <?php foreach ($panel->list_items as $item): ?>
                <div class="tw-flex tw-pb-12">
                    <div class="tw-w-24 tw-pr-12 tw-flex-shrink-0">
                    <?= make_image(Arr::get($item, 'image'), 'large', ['lazy img-responsive']) ?>
                    </div>
                    <div>
                        <h4 class="tw-text-lg tw-text-gray-800 tw-font-medium">
                            <?= Arr::get($item, 'heading') ?>
                        </h4>
                        <?php if ($description = Arr::get($item, 'description')): ?>
                        <p class="tw-text-base">
                            <?= Arr::get($item, 'description') ?>
                        </p>
                        <?php endif; ?>
                        <?php if ($link = Arr::get($item, 'link')): ?>
                        <div class="tw-text-base">
                            <?= View::make('partials/simple-link', [
                                'link' => Arr::get($item, 'link'),
                                'css' => 'tw-text-primary tw-text-base hover:tw-text-primary'
                            ]) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="w-full tw-max-w-md tw-mx-auto md:tw-mx-0 tw-mb-12 md:tw-mb-0 md:tw-w-1/2 md:tw-max-w-full tw-order-1 md:tw-order-2">
                <?= make_image(Arr::get($panel, 'image'), 'full', ['lazy img-responsive tw-ml-auto']) ?>
            </div>
        </div>
        <?php if ($panel->link): ?>
        <div class="tw-pt-12 tw-text-center">
            <?= View::make('partials/simple-link', [
                'link' => $panel->link,
                'css' => 'btn btn--colour-orange'
            ]) ?>
        </div>
        <?php endif; ?>
    </div>
</section>
