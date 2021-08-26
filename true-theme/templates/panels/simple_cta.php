<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

/**
 * @param array $panel
 * - items
 *   - heading
 *   - image
 *   - description
 *   - link
 */
$panel = new Fluent($panel);
?>
<section class="tw-relative tw-pt-40">
    <div class="container">
        <div class="tw-flex tw-flex-wrap tw--mx-6">
            <?php foreach ($panel->items as $item): ?>
            <div class="tw-w-full md:tw-w-1/3 tw-px-6 tw-mb-8">
                <div class="tw-bg-white tw-shadow-solid tw-p-12 tw-max-w-lg lg:tw-max-w-xl tw-mx-auto">
                    <div class="tw-flex">
                        <div class="tw-flex-shrink-0 tw-w-16 lg:tw-w-24">
                            <?= make_image(Arr::get($item, 'image'), 'large', ['lazy img-responsive']) ?>
                        </div>
                        <div class="tw-pl-8 tw-self-end">
                            <h4 class="tw-text-lg xl:tw-text-xl tw-text-gray-800 tw-font-medium"><?= Arr::get($item, 'heading') ?></h4>
                        </div>
                    </div>
                    <div class="tw-pt-12">
                        <?php if ($description = Arr::get($item, 'description')): ?>
                        <p class="tw-text-base tw-text-center">
                            <?= Arr::get($item, 'description') ?>
                        </p>
                        <?php endif; ?>
                        <?php if ($link = Arr::get($item, 'link')): ?>
                        <div class="tw-pt-12 tw-text-center tw-text-base">
                        <?= View::make('partials/simple-link', [
                            'link' => $link,
                            'css' => 'tw-text-primary hover:tw-text-primary'
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
