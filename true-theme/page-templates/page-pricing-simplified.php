<?php
    /**
     * Template Name: Pricing Simplified
     *
     */

?>
<div class="v1-theme">
    <?php
        TrueLib::getTemplatePart('page-banner'); 
    ?>
    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
        <div id="primary" class="site-content">
            <div id="content" role="main">

                <?php 
                    $packages = get_field('packages');
                    $packageDetails = get_field('package_details');
                    $packageMoreDetails = get_field('package_more_details');
                    $packageCount = count($packages);
                ?>

                <!-- Pricing - Desktop -->
                <?php if($packages): ?>
                <div class="pricing-table-desktop">
                    <table class="price-table price-table-main" cellpadding="0" cellspacing="0">
                        <caption>Plans Pricing Table</caption>
                        <!-- Table Header -->
                        <thead>
                            <tr>
                                <th></th>
                                <?php $i = 0; ?>
                                <?php foreach($packages as $package): ?>
                                    <th class="col-separator"></th>
                                    <th class="plan <?= $i == 0 ? 'top-left':'' ?> <?= $i == $packageCount - 1 ? 'top-right':'' ?> <?= $package['is_most_popular'] ? 'most-popular no-rounded-border': '' ?>">

                                        <?php if($package['is_most_popular']): ?>
                                            <div class="most-popular-title">Most Popular</div>
                                        <?php endif; ?>
                                    
                                        <h3 class="plan-name"><?= $package['package_name']; ?></h3>
                                        <div class="price"><?= $package['package_price']; ?></div>
                                        <div class="price-per-qty"><?= $package['package_price_per_qty']; ?></div>
                                    </th>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th></th>
                                <?php foreach($packages as $package): ?>
                                    <th class="col-separator"></th>
                                    <th class="plan <?= $package['is_most_popular'] ? 'most-popular': '' ?>">
                                        <?php if($package['call_to_action_text']): ?>
                                            <a class="plan-cta" href="<?= $package['call_to_action_url']; ?>"><?= $package['call_to_action_text']; ?></a>
                                        <?php endif; ?>
                                        
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <!-- Table Content -->
                        <tbody>
                            <?php foreach($packageDetails as $packageDetail): ?>
                                <tr class="<?= $packageDetail['add_border'] ? 'row-separator' : '' ?>">
                                    <td>
                                        <?php if($packageDetail['tooltip']): ?>
                                            <div class="plan-feature-tooltip">?</div>
                                            <div class="hidden-tip" style="display:none"><?= $packageDetail['tooltip']; ?></div>
                                        <?php endif; ?>

                                        <?= $packageDetail['feature_name']; ?>

                                        <?php if($packageDetail['feature_subtext']): ?>
                                            <span class="plan-subtext"><?= $packageDetail['feature_subtext'] ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <?php for($i = 1; $i <= $packageCount; $i++): ?>

                                        <td class="col-separator"></td>
                                        <td class="plan-value <?= $packages[$i - 1]['is_most_popular'] ? 'most-popular':'' ?>">
                                            <?php 
                                                $valueType = $packageDetail['value_type_' . $i];
                                                if($valueType == 'text') {
                                                    echo $packageDetail['package_text_' . $i];
                                                }
                                                else { // checkbox
                                                    if($packageDetail['package_checkbox_' . $i]) {
                                                        ?> <div class="green-tick-pricing"></div> <?php
                                                    }
                                                }
                                            ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                    <div class="price-view-more-content">
                        <table class="price-table" cellpadding="0" cellspacing="0">
                            <caption>Plans Pricing Table</caption>
                            <thead>
                                <tr>
                                    <th></th>

                                    <?php foreach($packages as $package): ?>
                                        <th class="col-separator"></th>
                                        <th class="plan">
                                            <h3 class="plan-name"><?= $package['package_name']; ?></h3>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($packageMoreDetails as $packageMoreDetail): ?>
                                    <tr class="<?= $packageMoreDetail['subfields'] ? 'parent':'' ?>">
                                        <td class="plan-feature"><?= $packageMoreDetail['feature_name']; ?></td>

                                        <?php for($i = 1; $i <= $packageCount; $i++): ?>

                                            <td class="col-separator"></td>
                                            <td class="plan-value <?= $packages[$i - 1]['is_most_popular'] ? 'most-popular':'' ?>">
                                                <?php
                                                    if($packageMoreDetail['package_checkbox_' . $i]) {
                                                        ?> <div class="green-tick-pricing"></div> <?php
                                                    }
                                                ?>
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                    <?php if($packageMoreDetail['subfields']): ?>
                                        <tr class="subfield">
                                            <td colspan="<?= 1 + ($packageCount * 2) ?>">
                                                <div class="subfield-wrapper">
                                                    <table class="price-table" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <?php foreach($packageMoreDetail['subfields'] as $subfield): ?>

                                                                <tr>
                                                                    <td class="plan-feature">

                                                                        <?php if($subfield['tooltip']): ?>
                                                                            <div class="plan-feature-tooltip">?</div>
                                                                            <div class="hidden"><?= $subfield['tooltip']; ?></div>
                                                                        <?php endif; ?>

                                                                        <?= $subfield['feature_name']; ?>
                                                                    </td>

                                                                    <?php for($i = 1; $i <= $packageCount; $i++): ?>

                                                                        <td class="col-separator"></td>
                                                                        <td class="plan-value <?= $packages[$i - 1]['is_most_popular'] ? 'most-popular':'' ?>">
                                                                            <?php
                                                                                if($subfield['package_checkbox_' . $i]) {
                                                                                    ?> <div class="green-tick-pricing"></div> <?php
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                    <?php endfor; ?>
                                                                </tr>

                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="price-view-more" data-expand-text="<?= get_field('more_details_action_text'); ?>" data-hide-text="<?= get_field('more_details_action_hide_text'); ?>"><span><?= get_field('more_details_action_text'); ?></span></div>

                </div>
                <?php endif; ?>

                <!-- Pricing - Mobile -->
                <?php if($packages): ?>
                <div class="pricing-table-mobile">
                    <?php $i = 1; ?>
                    <?php foreach($packages as $package): ?>
                        <div class="plan-mobile">
                            <div class="plan-heading">
                                <div class="plan-name-wrapper">
                                    <div>
                                        <?= $package['package_name']; ?>
                                    </div>

                                    <?php if($package['is_most_popular']): ?>
                                        <div class="most-popular-title">Most Popular</div>
                                    <?php endif ;?>
                                   
                                </div>
                                <div class="plan-price-wrapper">
                                    <div class="price"><?= $package['package_price']; ?></div>
                                    <div class="price-per-qty"><?= $package['package_price_per_qty']; ?></div>
                                </div>
                                <div class="plan-price-expand">
                                    <div class="expand-arrow"></div>
                                </div>
                            </div>
                            <div class="plan-details">

                                <?php if($package['call_to_action_text']): ?>
                                    <a class="plan-mobile-cta" href="<?= $package['call_to_action_url']; ?>"><?= $package['call_to_action_text']; ?></a>
                                <?php endif; ?>

                                <ul class="plan-details-list">
                                    <?php $featureIndex = 0; ?>
                                    <?php foreach($packageDetails as $packageDetail): ?>
                                        <li>
                                            <div class="details-left">
                                                <?php if($packageDetail['tooltip']): ?>
                                                    <a class="mobile-plan-feature-tooltip" href="#feature-tooltip-<?= $featureIndex ?>">?</a>
                                                    <div id="feature-tooltip-<?= $featureIndex ?>" class="tooltip-content mfp-hide"><?= $packageDetail['tooltip']; ?></div>
                                                <?php endif; ?>

                                                <?= $packageDetail['feature_name']; ?>

                                                <?php if($packageDetail['feature_subtext']): ?>
                                                    <span class="plan-subtext"><?= $packageDetail['feature_subtext'] ?></span>
                                                <?php endif; ?>

                                            </div>
                                            <div class="details-right">

                                                <?php 
                                                    $valueType = $packageDetail['value_type_' . $i];
                                                    if($valueType == 'text') {
                                                        echo $packageDetail['package_text_' . $i];
                                                    }
                                                    else { // checkbox
                                                        if($packageDetail['package_checkbox_' . $i]) {
                                                            ?> <div class="green-tick-pricing"></div> <?php
                                                        }
                                                    }
                                                ?>
                                                
                                            </div>
                                            <div class="clear"></div>
                                        </li>
                                        <?php $featureIndex++; ?>
                                    <?php endforeach; ?>
                                </ul>

                                <div class="price-view-more-mobile"  data-expand-text="<?= get_field('more_details_action_text'); ?>" data-hide-text="<?= get_field('more_details_action_hide_text'); ?>"><span><?= get_field('more_details_action_text'); ?></span></div>

                                <div class="price-view-more-content">
                                    <ul class="plan-details-list">

                                        <?php foreach($packageMoreDetails as $packageMoreDetail): ?>

                                            <li class="<?= $packageMoreDetail['subfields'] ? 'parent':'' ?>">

                                                <?php if($packageMoreDetail['package_checkbox_' . $i]): ?>

                                                    <div class="details-left">
                                                        <?php if(!$packageMoreDetail['subfields']): ?>
                                                            <?php if($packageMoreDetail['tooltip']): ?>
                                                                <a class="mobile-plan-feature-tooltip" href="#feature-tooltip-<?= $featureIndex ?>">?</a>
                                                                <div id="feature-tooltip-<?= $featureIndex ?>" class="tooltip-content mfp-hide"><?= $packageMoreDetail['tooltip']; ?></div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <?= $packageMoreDetail['feature_name']; ?>
                                                    </div>
                                                    <div class="details-right">
                                                        <?php
                                                            if($packageMoreDetail['package_checkbox_' . $i]) {
                                                                ?> <div class="green-tick-pricing"></div> <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="clear"></div>

                                                    <!-- Subfield -->
                                                    <?php if($packageMoreDetail['subfields']): ?>

                                                        <div class="subfield-wrapper">
                                                            <ul class="plan-details-list subfield">
                                                                <?php foreach($packageMoreDetail['subfields'] as $subfield) :?>

                                                                    <?php if($subfield['package_checkbox_' . $i]): ?>

                                                                        <li>
                                                                            <div class="details-left">
                                                                                <?php if($subfield['tooltip']): ?>
                                                                                    <a class="mobile-plan-feature-tooltip" href="#feature-tooltip-<?= $featureIndex ?>">?</a>
                                                                                    <div id="feature-tooltip-<?= $featureIndex ?>" class="tooltip-content mfp-hide"><?= $subfield['tooltip']; ?></div>
                                                                                <?php endif; ?>

                                                                                <?= $subfield['feature_name']; ?>
                                                                            </div>
                                                                            <div class="details-right">
                                                                                <?php
                                                                                    if($subfield['package_checkbox_' . $i]) {
                                                                                        ?> <div class="green-tick-pricing"></div> <?php
                                                                                    }
                                                                                ?>
                                                                            </div>
                                                                            <div class="clear"></div>
                                                                        </li>

                                                                    <?php endif; ?>
                                                                
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>

                                                <?php endif; ?>
                                                

                                            </li>

                                        <?php endforeach; ?>

                                        
                                    </ul>
                                </div>
                               
                            </div>
                        </div>
                    
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <!-- ./ Pricing - Mobile -->

                <?php if(get_field('fineprint')): ?>
                    <div class="pricing-fineprint entry-content">
                        <?= get_field('fineprint'); ?>
                    </div>
                <?php endif; ?>

                <?php
                    $faqs = get_field('faq');
                    
                    if(count($faqs) > 0) {
                        ?>
                        <div class="pricing-faq">
                            <h2 class="price-view-more"><span><?php the_field('faq_section_title')?></span></h2>

                            <div class="pricing-faq-container">
                                <?php 
                                    foreach($faqs as $faq) {
                                        ?>

                                        <div class="pricing-faq-item">
                                            <h3 class="pricing-simplified section-title"><?php echo $faq['question']?></h3>
                                            <div class="faq-description entry-content">
                                                <?php echo $faq['answer']?>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                ?>
                            </div>

                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>