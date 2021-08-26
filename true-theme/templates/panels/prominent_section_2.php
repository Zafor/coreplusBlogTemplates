<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

/**
 * @param array $panel
 * - heading
 * - description
 * - list_items
 *   - heading
 *   - image
 *   - description
 *   - link
 */
$panel = new Fluent($panel);
?>
<section class="tw-relative tw-mt-40 tw-pt-40 tw-pb-32 tw-bg-gray-100">
    <div class="container">
        <div class="tw-text-center tw-pb-12 tw-max-w-2xl tw-mx-auto">
            <?php if ($panel->heading): ?>
            <h3 class="tw-text-primary">
                <?= $panel->heading ?>
            </h3>
            <?php endif; ?>
            <?php if ($panel->description): ?>
            <p class="tw-text-base">
                <?= $panel->description ?>
            </p>
            <?php endif; ?>
        </div>
        <div class="tw-flex tw-flex-wrap tw--mx-6">
            <?php foreach ($panel->list_items as $item): ?>
            <div class="tw-w-full sm:tw-w-1/2 md:tw-w-1/4 tw-mb-8 tw-px-6 tw-flex">
                <div class="tw-bg-white tw-max-w-2xl tw-shadow-solid tw-mx-auto tw-py-12 tw-px-6 tw-flex tw-flex-col">
                    <div class="tw-w-48 tw-mx-auto tw-mb-12">
                        <?= make_image(Arr::get($item, 'image'), 'large', ['lazy img-responsive']) ?>
                    </div>
                    <div class="tw-text-center tw-flex-grow tw-flex tw-flex-col tw-justify-between">
                        <div>
                            <h4 class="tw-text-lg tw-font-medium tw-text-gray-800">
                                <?= Arr::get($item, 'heading') ?>
                            </h4>
                            <?php if ($description = Arr::get($item, 'description')): ?>
                            <p class="tw-text-base">
                                <?= Arr::get($item, 'description') ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <?php if ($link = Arr::get($item, 'link')): ?>
                        <div class="tw-text-base">
                            <?= View::make('partials/simple-link-arrow', [
                                'link' => Arr::get($item, 'link'),
                                'css' => 'tw-text-primary tw-text-base hover:tw-text-primary tw-inline-flex tw-items-center',
                                'arrowCss' => 'tw-text-primary tw-text-base tw-w-4 tw-h-4 tw-ml-2'
                            ]) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
