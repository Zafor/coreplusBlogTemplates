<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

/**
 * @param array $panel
 * - heading
 * - description If 'style' is 'with_text'
 * - image If 'style' is 'with_image'
 * - link
 */
$panel = new Fluent($panel);
?>
<section class="tw-relative tw-pt-40">
    <div class="container">
        <div class="tw-flex tw-flex-col sm:tw-flex-row tw-justify-between tw-items-center">
            <div class="tw-max-w-md tw-order-2 sm:tw-order-1 tw-text-center sm:tw-text-left">
                <?php if ($panel->heading): ?>
                <h3 class="tw-text-primary tw-mb-12">
                    <?= $panel->heading ?>
                </h3>
                <?php endif; ?>
                <?php if ($panel->description): ?>
                <p class="tw-text-base tw-mb-12">
                    <?= $panel->description ?>
                </p>
                <?php endif; ?>
                <?php if ($panel->link): ?>
                <?= View::make('partials/simple-link', [
                    'link' => $panel->link,
                    'css' => 'btn btn--colour-orange'
                ]) ?>
                <?php endif; ?>
            </div>
            <div class="tw-max-w-xl sm:tw-max-w-full tw-order-1 sm:tw-order-2 tw-pb-8 sm:tw-pb-0">
                <?= make_image($panel->image, 'full', ['lazy img-responsive']) ?>
            </div>
        </div>
    </div>
</section>
