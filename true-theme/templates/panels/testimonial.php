<?php
use Illuminate\Support\Arr;

/**
 * @param array $panel
 *  - {string} heading
 *  - {string} intro
 *  - {array}  items
 */

$backgroundUrl = TrueLib::getImageUrl('lp/testimonial-bg-aspect-2-1.jpg');
$backgroundUrlMobile = TrueLib::getImageUrl('lp/testimonial-bg-aspect-1-1.jpg');
$positions = [
    [ 'styles' => 'top: 24%; left: 12.4%;', 'placement' => 'bottom' ],
    [ 'styles' => 'top: 31.2%; left: 33.6%;', 'placement' => 'right' ],
    [ 'styles' => 'top: 25.3%; left: 67.2%;', 'placement' => 'bottom' ],
    [ 'styles' => 'top: 29%; left: 85.3%', 'placement' => 'left' ],
    [ 'styles' => 'top: 67.1%; left: 12.8%', 'placement' => 'top' ],
    [ 'styles' => 'top: 70.5%; left: 30.7%', 'placement' => 'top' ],
    [ 'styles' => 'top: 85.1%; left: 47.8%', 'placement' => 'top' ],
    [ 'styles' => 'top: 81%; left: 63.5%', 'placement' => 'top' ],
    [ 'styles' => 'top: 59%; left: 70.4%', 'placement' => 'top' ],
    [ 'styles' => 'top: 89.8%; left: 88%', 'placement' => 'top' ],
];
$positionsMobile = [
    [ 'styles' => 'top: 28.8%; left: 14%;', 'placement' => 'bottom' ],
    [ 'styles' => 'top: 22.8%; left: 88.3%;', 'placement' => 'bottom' ],
    [ 'styles' => 'top: 72.8%; left: 7.7%;', 'placement' => 'top' ],
    [ 'styles' => 'top: 59.5%; left: 95.4%', 'placement' => 'top' ],
    [ 'styles' => 'top: 88.6%; left: 45.8%', 'placement' => 'top' ],
    [ 'styles' => 'top: 83.9%; left: 80.3%', 'placement' => 'top' ],
];
$testimonials = Arr::get($panel, 'items', []);
?>
<section class="tw-pt-40 tw-relative">
    <!-- Text content layer -->
    <div class="tw-transform tw--translate-y-20 sm:tw-translate-x-0 tw-w-full tw-absolute tw-h-full tw-z-10 tw-flex tw-items-start">
        <div class="container-fluid">
            <div class="tw-text-center tw-max-w-5xl tw-mx-auto">
                <h3 class="tw-text-primary"><?= $panel['heading'] ?></h3>
                <?php if (isset($panel['intro'])): ?>
                <p class="tw-max-w-4xl tw-mx-auto tw-text-base">
                <?= $panel['intro'] ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- ./ Text content layer -->
    <div class="tw-relative tw-w-screen tw-pb-full md:tw-pb-1/2">
        <!-- Background image layer -->
        <div class="tw-absolute tw-inset-0 tw-opacity-25 tw-transform">
            <div class="lazy lazy--bg tw-bg-center tw-bg-cover tw-absolute tw-w-full tw-h-full tw-hidden md:tw-block" data-bg="<?= $backgroundUrl ?>"></div>
            <div class="lazy lazy--bg tw-bg-center tw-bg-cover tw-absolute tw-w-full tw-h-full tw-block md:tw-hidden" data-bg="<?= $backgroundUrlMobile ?>"></div>
        </div>
        <!-- ./ Background image layer -->
        <!-- Desktop bubbles -->
        <div class="tw-w-full tw-h-full tw-absolute tw-transform tw-top-0 tw-left-0 tw-z-10 tw-hidden md:tw-block">
            <?php $testimonialIndex = 0; ?>
            <?php foreach ($testimonials as $item): ?>
            <div class="tw-absolute tw-w-1px tw-h-1px"
                style="<?= $positions[$testimonialIndex]['styles'] ?>">
                <button
                    type="button"
                    data-control="testimonials"
                    data-auto-expand="<?= $item['is_auto_expanded'] ? 'true' : 'false' ?>"
                    data-testimonial-id="testimonial_<?= $testimonialIndex + 1 ?>"
                    data-placement="<?= $positions[$testimonialIndex]['placement'] ?>"
                    data-template="testimonial_content_<?= $testimonialIndex + 1 ?>"
                    class="tw-appearance-none tw-border-0 focus:tw-outline-none tw-bg-transparent tw-cursor-pointer tw-relative tw-rounded-full tw-overflow-hidden tw-w-20 tw-h-20 tw--mt-10 tw--ml-10">
                    <img src="<?= Arr::get($item, 'avatar.sizes.thumbnail') ?>"
                        class="tw-w-full tw-h-full tw-object-cover tw-absolute tw-top-0 tw-left-0"
                        alt="">
                </button>
            </div>
            <?php $testimonialIndex++; ?>
            <?php endforeach ?>
        </div>
        <!-- ./ Desktop bubbles -->
        <!-- Mobile bubbles -->
        <div class="tw-w-full tw-h-full tw-absolute tw-top-0 tw-transform tw-left-0 tw-z-10 tw-block md:tw-hidden">
            <?php $testimonialIndex = 0; ?>
            <?php $max = 6; ?>
            <?php foreach ($testimonials as $item): ?>
            <div class="tw-absolute tw-w-1px tw-h-1px"
                style="<?= $positionsMobile[$testimonialIndex]['styles'] ?>">
                <button
                    type="button"
                    data-control="testimonials"
                    data-testimonial-id="mobile_testimonial_<?= $testimonialIndex + 1 ?>"
                    data-placement="<?= $positionsMobile[$testimonialIndex]['placement'] ?>"
                    data-template="testimonial_content_<?= $testimonialIndex + 1 ?>"
                    class="tw-appearance-none tw-border-0 focus:tw-outline-none tw-bg-transparent tw-cursor-pointer tw-relative tw-rounded-full tw-overflow-hidden tw-w-20 tw-h-20 tw--mt-10 tw--ml-10">
                    <img src="<?= Arr::get($item, 'avatar.sizes.thumbnail') ?>"
                        class="tw-w-full tw-h-full tw-object-cover tw-absolute tw-top-0 tw-left-0"
                        alt="">
                </button>
            </div>
            <?php
                $testimonialIndex++;
                if ($testimonialIndex >= $max) {
                    break;
                }
            ?>
            <?php endforeach ?>
        </div>
        <!-- ./ Desktop bubbles -->
        <!-- Tippy popover templates -->
        <div style="display: none;">
            <?php $testimonialIndex = 0; ?>
            <?php foreach ($testimonials as $item): ?>
            <div id="testimonial_content_<?= ($testimonialIndex + 1) ?>">
                <div class="tw-p-4 sm:tw-max-w-lg">
                    <div class="items-center tw-flex tw-mb-6">
                        <div>
                            <div class="tw-font-bold">
                                <?= $item['name'] ?>
                            </div>
                            <div class="tw-text-xs tw-text-gray-600">
                                <?= $item['handle'] ?>
                            </div>
                        </div>
                        <svg
                            class="tw-ml-auto tw-pl-6 tw-flex-shrink-0"
                            width="34" height="25"
                            viewBox="0 0 34 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.15">
                            <path d="M0 24.9995L1.09276e-06 12.4997L8.33318 12.4997C8.33318 7.90607 4.59783 4.16656 1.82127e-06 4.16656L2.18553e-06 -3.43323e-05C6.89259 -3.37297e-05 12.4998 5.60716 12.4998 12.4997L12.4998 24.9995L0 24.9995Z" fill="#4E4E50"/>
                            <path d="M20.833 24.9995L20.833 12.4997L29.1662 12.4997C29.1662 7.90607 25.4308 4.16656 20.833 4.16656L20.833 -3.43323e-05C27.7256 -3.37297e-05 33.3328 5.60716 33.3328 12.4997L33.3328 24.9995L20.833 24.9995Z" fill="#4E4E50"/>
                            </g>
                        </svg>
                    </div>
                    <div>
                        <p>
                            <?= $item['content'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php $testimonialIndex++; ?>
            <?php endforeach ?>
        </div>
        <!-- ./ Tippy popover templates -->
    </div>
</section>
