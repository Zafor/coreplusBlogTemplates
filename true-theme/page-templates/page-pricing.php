<?php
    /**
     * Template Name: Pricing
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
                
                <!-- Pricing Selector -->
                <div class="pricing-top">
                    <h2 class="orange-heading"><?php the_field('selection_title')?></h2>

                    <div class="pricing-steps">
                        <div class="pricing-bar gray"></div>
                        <div class="pricing-bar orange"></div>
                        <!-- Column 1-->
                        <div class="pricing-column column-1" data-step-no="1">
                            <div class="pricing-step-no">
                                 <div class="pricing-step-active"></div>
                            </div>
                        </div>
                        
                        <!-- Columm 2 -->
                        <div class="pricing-column column-2" data-step-no="2">
                            <div class="pricing-step-no">
                                 <div class="pricing-step-active"></div>
                            </div>
                        </div>
                        
                        <!-- Column 3 -->
                        <div class="pricing-column column-3" data-step-no="3">
                            <div class="pricing-step-no">
                                 <div class="pricing-step-active"></div>
                            </div>
                        </div>
                        
                        <!-- Column 4 -->
                        <div class="pricing-column column-4 last" data-step-no="4">
                            <div class="pricing-step-no">
                                 <div class="pricing-step-active"></div>
                                 <div class="pricing-step-loader"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="pricing-steps fields">
                        <div class="pricing-column column-1" data-step-no="1">
                            <div class="pricing-column-title hastooltip"><?php echo do_shortcode(get_field('part_time_users_title'))?></div>
                            <div class="hidden">
                                <?php the_field('part_time_user_definition')?>
                            </div>
                            
                            <select class="chosen-select true-chosen" id="partTimeSelect" autocomplete="off">
                                <option value="-1" selected>Choose an option</option>
                                <option value="0">No Part-Time Users</option>
                                <?php
                                    $intTotalPartTime = (int)get_field('max_number_of_part_time_users');
                                    
                                    if($intTotalPartTime == 0) $intTotalPartTime = 1;
                                    for($i = 1; $i <= $intTotalPartTime; $i++)
                                    {
                                        ?>
                                        <option value="<?php echo $i?>"><?php echo $i?> Part-Time User<?php if($i != 1) echo 's'?></option>
                                        <?php
                                    }
                                ?>
                                <option value="contact"><?php echo $intTotalPartTime?>+ Part-Time Users</option>
                            </select>
                        </div>
                        
                        <!-- Columm 2 -->
                        <div class="pricing-column column-2" data-step-no="2">                            
                            <div class="pricing-column-title hastooltip"><?php echo do_shortcode(get_field('full_time_users_title'))?></div>
                            <div class="hidden">
                                <?php the_field('full_time_user_definition')?>
                            </div>
                            
                            <select class="chosen-select" id="fullTimeSelect" autocomplete="off">
                                <option value="-1" selected>Choose an option</option>
                                <option value="0">No Full-Time Users</option>
                                <?php
                                    $intTotalFullTime = (int)get_field('max_number_of_full_time_users');
                                    
                                    if($intTotalFullTime == 0) $intTotalFullTime = 1;
                                    for($i = 1; $i <= $intTotalFullTime; $i++)
                                    {
                                        ?>
                                        <option value="<?php echo $i?>"><?php echo $i?> Full-Time User<?php if($i != 1) echo 's'?></option>
                                        <?php
                                    }
                                ?>
                                <option value="contact"><?php echo $intTotalFullTime?>+ Full-Time Users</option>
                            </select>
                        </div>
                        
                        <!-- Column 3 -->
                        <div class="pricing-column column-3" data-step-no="3">                            
                            <div class="pricing-column-title"><?php the_field('subscription_title')?></div>
                            
                            <select class="chosen-select" id="subscriptionSelect" autocomplete="off">
                                <option value="-1" selected>Choose an option</option>
                                <?php
                                    if(get_field('subscriptions'))
                                    {
                                        while(has_sub_field('subscriptions'))
                                        {
                                            ?>
                                            <option value="<?php echo get_sub_field('subid')?>"><?php echo get_sub_field('name')?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <!-- Column 4 -->
                        <div class="pricing-column column-4 last" data-step-no="4">                            
                            <div class="pricing-column-title"><?php the_field('est_price_title')?></div>
                            
                            <div class="pricing-total">
                                
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                
                <!-- Result -->
                <div class="pricing-result">
                    <h2 class="faq-heading"><?php the_field('price_result_title')?></h2>
                    
                    <?php
                        $plans = TruePricing::getPlans();
                    ?>
                    <div class="pricing-boxes">
                        <?php
                            foreach($plans as $plan)
                            {
                                ?>
                                <div class="pricing-box-item plan-box-id-<?php echo $plan->ID?> <?php if(get_field('is_multi', $plan->ID)) echo 'multi'?>" data-default-price="<?php echo get_field('default_price', $plan->ID)?>">
                                    <div class="pricing-plan-header">
                                        <span class="pricing-plan-name"><?php echo $plan->post_title?></span>
                                    </div>
                                    <div class="pricing-plan-price">
                                        <div><?php echo get_field('default_price', $plan->ID)?></div>
                                        
                                        <span>
                                            <?php
                                                if(trim(get_field('default_price_sub_title', $plan->ID)) != '')
                                                {
                                                    echo get_field('default_price_sub_title', $plan->ID);
                                                }
                                            ?>
                                            &nbsp;
                                        </span>
                                    </div>
                                    <?php
                                        if(trim(get_field('free_trial_button_text')) != '')
                                        {
                                            ?>
                                            <a class="button" href="<?php echo get_permalink(TRIAL_PAGE_ID)?>"><?php the_field('free_trial_button_text')?></a>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <?php
                            }
                        ?>
                        
                        <!-- Custom Quote -->
                        <div class="pricing-box-item plan-box-id-contact">
                            <div class="pricing-plan-header">
                                <span class="pricing-plan-name">Contact</span>
                            </div>
                            <div class="pricing-plan-price pricing-get-quote">
                                <?php echo get_field('contact_us_message')?>
                            </div>
                        </div>  
                    </div>
                    <div class="clear"></div>
                    <!-- Features Container -->
                    <div class="pricing-plan-features-container">
                        <?php
                            foreach($plans as $plan)
                            {
                                ?>
                                <div class="pricing-plan-features plan-id-<?php echo $plan->ID?>">
                                    <?php
                                        $pricingTitle = str_replace('{PLAN_NAME}', '<span class="pricing-plan-name">' . $plan->post_title . '</span>', get_field('selected_plan_title'));
                                    ?>
                                    <h3 class="section-title tc"><?php echo $pricingTitle?></h3>
                                    
                                    <ul>
                                        <?php
                                            if(get_field('features', $plan->ID))
                                            {
                                               while(has_sub_field('features', $plan->ID))
                                               {
                                                  ?>
                                                  <li><?php the_sub_field('feature_name')?></li>
                                                  <?php 
                                               }     
                                            }
                                        ?>
                                    </ul>

                                    <div class="pricing-plan-footer"><?=get_field('excluding_gst_notice')?></div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    
                </div>
				
				<style type="text/css">
					.pricing-faq-item h3.section-title {
						cursor: default;
					}
					.pricing-faq-item h3.section-title:after {
						display: none;
					}
					
					.pricing-faq-item:last-child {
						border-bottom: 0;
					}
				
					.pricing-faq-item {
						border-top: 0;
					}
					.pricing-faq-item:hover {
						background-color: transparent;
					}
				</style>
                
                <?php
                    $faqs = get_field('faq');
                    
                    if(count($faqs) > 0)
                    {
                        //Sort them into columns
                        $columns = array('left' => array(), 'right' => array());
                        
                        $currColumn = 'left';
                        foreach($faqs as $faq)
                        {
                            $columns[$currColumn][] = $faq;
                            
                            if($currColumn == 'left')
                            {
                                $currColumn = 'right';
                            } else {
                                $currColumn = 'left';
                            }
                        }
                        
                        function printPricingFAQItem($faq)
                        {
                            ?>
                            <div class="pricing-faq-item">
                                <h3 class="section-title"><?php echo $faq['question']?></h3>
                                <div class="faq-description entry-content" style="display: block !important">
                                    <?php echo $faq['answer']?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="pricing-faq">
                            <h2 class="faq-heading"><?php the_field('faq_section_title')?></h2>
                            
                            <div class="pricing-faq-container" style="display: block !important">
                                <div class="pricing-faq-left">
                                    <?php
                                        foreach($columns['left'] as $faq)
                                        {
                                            printPricingFAQItem($faq);
                                        }
                                    ?>
                                </div>
                                <?php
                                    if(count($columns['right']) > 0)
                                    {
                                        ?>
                                        <div class="pricing-faq-right">
                                            <?php
                                                foreach($columns['right'] as $faq)
                                                {
                                                    printPricingFAQItem($faq);
                                                }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <div class="clear"></div>
                            </div>
                            
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>