<?php
/**
 * Template Name: Trial - Custom Form
 *
 */
?>
<!-- Load external scripts -->
<script src="https://www.google.com/recaptcha/api.js?render=<?= env('RECAPTCHA_SITE_KEY') ?>"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@0.4.0/dist/lottie-player.js"></script>
<script>
window._trial_form = {
    captchaSiteKey: '<?= env('RECAPTCHA_SITE_KEY') ?>',
    nonce: '<?= wp_create_nonce('trial') ?>',
    cms: {
        panel_heading: "<?= get_field('panel_heading') ?>",
        form_heading: "<?= get_field('form_heading') ?>",
        form_description: "<?= get_field('form_description') ?>",
        form_footer_text: "<?= get_field('form_footer_text') ?>",
        bg: "<?= TrueLib::getImageUrl('trial/trial-bg.png') ?>",
    }
}
</script>
<!--
<div class="v1-theme">
    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
    </div>
</div> -->
<div id="vueTrialForm">
    <div class="tw-relative tw-overflow-hidden tw-pb-24">
        <div class="js-trial-placeholder tw-pb-24 tw-pt-24">
            <div class="tw-relative tw-py-24 tw-bg-white tw-rounded tw-border tw-border-gray-200 tw-px-12 tw-max-w-6xl tw-mx-auto ">
                <div class="tw-rounded tw-h-12 tw-bg-gray-200 tw-w-full tw-animate-pulse tw-mb-24"></div>
                <div class="tw-flex tw-flex-col tw-px-4 tw-max-w-2xl tw-mx-auto tw-space-y-8">
                    <div class="tw-w-full tw-bg-gray-200 tw-h-8 tw-rounded tw-animate-pulse"></div>
                    <div class="tw-w-full tw-bg-gray-200 tw-h-8 tw-rounded tw-animate-pulse"></div>
                    <div class="tw-w-full tw-bg-gray-200 tw-h-8 tw-rounded tw-animate-pulse"></div>
                    <div class="tw-w-full tw-bg-gray-200 tw-h-8 tw-rounded tw-animate-pulse"></div>
                    <div class="tw-w-full tw-bg-gray-200 tw-h-8 tw-rounded tw-animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tw-bg-teal tw-relative tw-z-40">
    <div class="tw-max-w-800px tw-mx-auto tw-py-24 tw-px-12 md:tw-px-8">
        <div class="tw-flex tw-flex-wrap tw--mx-8">
            <?php foreach ([
                'feature_list_1',
                'feature_list_2',
                'feature_list_3',
            ] as $key): ?>
            <div class="tw-flex tw-flex-col tw-mb-6 tw-w-full sm:tw-w-1/2 md:tw-w-1/3 tw-px-8 tw-space-y-6">
                <?php foreach (get_field($key) as $field): ?>
                <div class="tw-items-center tw-inline-flex">
                    <div class="tw-w-12 tw-mr-4 tw-flex-shrink-0 tw-inline-flex tw-items-center">
                        <?= view('svg/tick') ?>
                    </div>
                    <div class="tw-text-white tw-text-base">
                        <?= $field['text'] ?>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <?php endforeach ?>
        </div>
        <div class="tw-text-center tw-font-semibold tw-pt-12 tw-text-white tw-pb-2">
            <div>And much more...</div>
        </div>

    </div>
</div>
