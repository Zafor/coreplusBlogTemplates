<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

/**
 * @param array $panel
 * - heading
 * - description
 * - posts Array of blog posts
 */
$panel = new Fluent($panel);
?>
<section class="tw-relative tw-mt-40 tw-pt-40 tw-pb-32 tw-bg-gray-100">
    <div class="container tw-pt-4 tw-pb-4">
        <div class="tw-text-center tw-pb-12 tw-max-w-4xl tw-mx-auto">
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
            <?php foreach ($panel->get('posts', []) as $post): ?>
            <?php
                setup_postdata($post);
                $excerpt = get_the_excerpt($post);
                $excerpt = substr($excerpt, 0, 160);
                $excerpt = wp_strip_all_tags(substr($excerpt, 0, strrpos($excerpt, ' ')) . '...');
                // echo $excerpt;
            ?>
            <div class="tw-w-full sm:tw-w-1/2 lg:tw-w-1/3 tw-mb-12 tw-px-6 tw-flex">
                <a href="<?= get_permalink($post) ?>"
                    class="tw-block tw-text-black tw-rounded-sm tw-overflow-hidden hover:tw-text-black hover:tw-no-underline tw-shadow-sm hover:tw-shadow-lg tw-transition tw-duration-150 tw-ease-in tw-flex tw-flex-col">
                    <div class="tw-relative tw-w-full tw-pb-2/3 tw-bg-gray-200">
                        <img data-src="<?= wp_get_attachment_image_url(get_post_thumbnail_id($post), 'large') ?>"
                            class="lazy tw-top-0 tw-left-0 tw-absolute tw-w-full tw-h-full tw-object-cover tw-object-center"
                            alt="<?= $post->post_title ?>">
                    </div>
                    <div class="tw-bg-white tw-px-12 tw-pt-8 tw-pb-4 tw-items-center tw-flex tw-space-x-8">
                        <div class="tw-rounded-full tw-overflow-hidden tw-shadow-lg tw-w-12 tw-h-12 tw-flex-shrink-0">
                            <?php echo get_avatar($post->post_author, 30); ?>
                        </div>
                        <div class="tw-text-xs">
                            <?php echo get_the_date('F j, Y', $post) ?>
                        </div>
                        <div class="tw-text-xs">
                            <span class="tw-text-gray-700">By</span> <?php echo get_the_author() ?>
                        </div>
                    </div>
                    <div class="tw-bg-white tw-pt-4 tw-pb-12 tw-px-12 tw-flex-grow">
                        <h4>
                            <?= $post->post_title ?>
                        </h4>
                        <p class="tw-text-base tw-opacity-75">
                            <?= $excerpt ?>
                        </p>
                        <div class="mt-2">
                            <span class="tw-inline-flex tw-items-center tw-text-primary tw-text-base">
                                Read More
                                <svg class="tw-w-4 tw-h-4 tw-ml-2" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.16 -0.000121517L7.4832 0.760053L10.1616 3.7738L-1.88833e-07 3.7738L-1.4687e-07 4.85206L10.1616 4.85206L7.4784 7.86041L8.16 8.62598L12 4.31293L8.16 -0.000121517Z" fill="#F8A94C"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>
