<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

/**
 * @param array $panel
 * - style  'with_text'|'with_image'
 * - heading
 * - description If 'style' is 'with_text'
 * - image If 'style' is 'with_image'
 * - link
 */
$panel = new Fluent($panel);
$verticalPadding = $panel->style === 'with_image' ? 'tw-py-8' : 'tw-py-32';
?>
<section class="tw-relative tw-bg-primary <?= $verticalPadding ?>">
    <div class="container">
        <?php if ($panel->style === 'with_image'): ?>
        <div class="tw-flex tw-justify-between tw-items-center">
            <div class="tw-max-w-lg">
                <?php if ($panel->heading): ?>
                <h3 class="tw-text-white tw-mb-12">
                    <?= $panel->heading ?>
                </h3>
                <?php endif; ?>
                <?php if ($panel->link): ?>
                <?= View::make('partials/simple-link', [
                    'link' => $panel->link,
                    'css' => 'btn btn--colour-white'
                ]) ?>
                <?php endif; ?>
            </div>
            <div class="tw-max-w-sm sm:tw-max-w-4xl">
                <?= make_image($panel->image, 'full', ['lazy img-responsive']) ?>
            </div>
        </div>
        <?php elseif ($panel->style === 'with_text'): ?>
        <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-center">
            <div class="md:tw-pr-12 tw-max-w-4xl tw-text-center md:tw-text-left">
                <?php if ($panel->heading): ?>
                <h3 class="tw-text-white tw-mb-6">
                    <?= $panel->heading ?>
                </h3>
                <?php endif; ?>
                <?php if ($panel->description): ?>
                <p class="tw-text-white tw-text-base">
                    <?= $panel->description ?>
                </p>
                <?php endif; ?>
            </div>
            <div class="tw-max-w-sm sm:tw-max-w-4xl tw-mt-8 md:tw-mt-0">
                <?php if ($panel->link): ?>
                <?= View::make('partials/simple-link', [
                    'link' => $panel->link,
                    'css' => 'btn btn--colour-white'
                ]) ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
