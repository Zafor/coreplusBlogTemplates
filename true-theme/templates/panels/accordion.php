<?php
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Fluent;

/**
 * @param array $panel
 * - heading
 * - description
 * - sections Array
 *   - section_heading
 *   - items Array
 *     - heading
 *     - content
 */
$panel = new Fluent($panel);
?>
<section class="tw-relative tw-mt-40 tw-pt-40 tw-pb-40 tw-bg-gray-100">
    <div class="container">
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
        <div class="" data-control="nav-tabs">
            <!-- Nav tabs -->
            <ul class="tw-overflow-x-auto tw-list-none tw-pl-0 tw-mb-4 tw-flex tw-space-x-4" role="tablist">
            <?php $accordionIndex = 0; ?>
            <?php foreach ($panel->get('sections', []) as $section): ?>
                <li role="presentation"
                    class="tw-transition tw-flex-shrink-0 tw-duration-100  tw-ease-in <?= $accordionIndex === 0 ? 'active' : '' ?>">
                    <a href="#accordion_<?= Str::slug(Arr::get($section, 'section_heading')) ?>"
                        aria-controls="home"
                        role="tab"
                        class="tw-block tw-cursor-pointer tw-rounded-md tw-text-base tw-px-12 tw-py-4 hover:tw-no-underline focus:tw-no-underline "
                        data-toggle="tab">
                        <?= Arr::get($section, 'section_heading') ?>
                    </a>
                </li>
            <?php $accordionIndex++; ?>
            <?php endforeach ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
            <?php $accordionIndex = 0; ?>
            <?php foreach ($panel->get('sections', []) as $section): ?>
            <div role="tabpanel"
                class="tab-pane <?= $accordionIndex === 0 ? 'active' : '' ?>"
                id="accordion_<?= Str::slug(Arr::get($section, 'section_heading')) ?>">
                <?php $collapseIndex = 0; ?>
                <?php foreach (Arr::get($section, 'items', []) as $collapsible): ?>
                <?php
                    $collapseKey = "accordion_" . Str::slug(Arr::get($section, 'section_heading')) . "_" . $collapseIndex;
                ?>
                <div class="tw-p-8 tw-bg-white tw-rounded-md tw-shadow-solid tw-mb-2">
                    <div>
                        <a role="button"
                            data-toggle="collapse"
                            href="#<?= $collapseKey ?>"
                            aria-expanded="true"
                            class="tw-flex tw-w-full tw-items-center tw-justify-between hover:tw-no-underline focus:tw-no-underline"
                            aria-controls="<?= $collapseKey ?>">
                            <div class="tw-text-gray-800 tw-font-medium">
                                <?= Arr::get($collapsible, 'heading') ?>
                            </div>
                            <svg
                                class="js-collapse-indicator tw-flex-shrink-0 tw-ml-12 tw-transform tw-transition tw-duration-150 tw-ease-in"
                                 width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 2.5C8.1 2.5 2.5 8.1 2.5 15C2.5 21.9 8.1 27.5 15 27.5C21.9 27.5 27.5 21.9 27.5 15C27.5 8.1 21.9 2.5 15 2.5ZM15 5C20.5125 5 25 9.4875 25 15C25 20.5125 20.5125 25 15 25C9.4875 25 5 20.5125 5 15C5 9.4875 9.4875 5 15 5ZM10 13.75L15 18.75L20 13.75H10Z" fill="black" fill-opacity="0.54"/>
                            </svg>
                        </a>
                    </div>
                    <div id="<?= $collapseKey ?>"
                        class="collapse">
                        <div class="tw-pt-4 tw-text-base tw-text-gray-800">
                            <?= Arr::get($collapsible, 'content') ?>
                        </div>
                    </div>
                </div>
                <?php $collapseIndex++; ?>
                <?php endforeach ?>
            </div>
            <?php $accordionIndex++; ?>
            <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
