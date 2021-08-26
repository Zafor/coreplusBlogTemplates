<?php
/**
 * Template Name: About Us
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
            <div class="about-top">
    			<h3><?=get_field('main_title')?></h3>
    			<p><?=get_field('slogan')?></p>
    		</div>
    		<div class="about-left-col">
    			<h4 class="pink"><?=get_field('magenta_title')?></h4>
    			<div class="entry-content"><?=get_field('magenta_text')?></div>
    			<h4 class="orange"><?=get_field('orange_title')?></h4>
    			<div class="entry-content"><?=get_field('orange_text')?></div>
    			<h4 class="aqua"><?=get_field('aqua_title')?></h4>
    			<div class="entry-content"><?=get_field('aqua_text')?></div>
    		</div>
    		
    		<div class="about-right-col">
    		    <!-- Desktop Version -->
    		    <div class="about-logo-full">
    		        <div class="triangle-container">
    		            <!-- Triangles -->
    		            
    		            <div class="logo-triangle pink-tri"></div>
    		            <div class="logo-triangle yellow-tri"></div>
    		            <div class="logo-triangle light-yellow-tri"></div>
    		            
    		            <div class="logo-triangle blue-tri"></div>
    		            <div class="logo-triangle light-blue-tri"></div>

                        <div class="logo-triangle orange-tri"></div>
                        <div class="logo-triangle light-orange-tri"></div>
                        
                        
                        <div class="logo-triangle gray-tri"></div>
                        
                        <!-- Lines -->
                        <div class="yellow-line logo-line" data-true-width="177" data-true-height="26" data-true-direction="up">
                            <img src="<?php echo TrueLib::getImageURL('logo/line-2.png')?>" alt="">
                            <div class="logo-line-inner">
                                <span data-target="yellow-tri">
                                    <a href="<?php echo site_url('cashflow-medicare-claiming/')?>">
                                        Cash Flow
                                    </a>
                                </span>
                            </div>
                        </div>
                        
                        <div class="orange-line logo-line" data-true-width="153" data-true-height="71" data-true-direction="down">
                            <img src="<?php echo TrueLib::getImageURL('logo/line-5.png')?>" alt="">
                            <div class="logo-line-inner">
                                <span data-target="orange-tri">
                                    <a href="<?php echo site_url('referrer-network/')?>">
                                        Referrals
                                    </a>
                                </span>
                            </div>
                        </div>
                        
                        <div class="purple-line logo-line" data-true-width="145" data-true-height="118" data-true-direction="down">
                            <img src="<?php echo TrueLib::getImageURL('logo/line-14.png')?>" alt="">
                            <div class="logo-line-inner">
                                <span data-target="pink-tri">
                                    <a href="#">
                                        Practice Management
                                    </a>
                                </span>
                            </div>
                        </div>
                        
                        <div class="blue-line logo-line" data-true-width="166" data-true-height="33" data-true-direction="up">
                            <img src="<?php echo TrueLib::getImageURL('logo/line-1.png')?>" alt="">
                            <div class="logo-line-inner">
                                <span data-target="blue-tri">
                                    <a href="<?php echo site_url('features/integrations/') ?>">
                                        Online Add-ons
                                    </a>
                                </span>
                                
                            </div>
                        </div>
                        
                        <div class="light-blue-line logo-line" data-true-width="124" data-true-height="36" data-true-direction="up">
                            <img src="<?php echo TrueLib::getImageURL('logo/line-3.png')?>" alt="">
                            <div class="logo-line-inner">
                                <span data-target="light-blue-tri">
                                    <a href="#">
                                        E-Health
                                    </a>
                                </span>
                            </div>
                        </div>
    		        </div>
    		    </div>
    		    
    		    
    		    <!-- Mobile Logo -->
    		    <div class="about-logo-mobile">
        			<?php 
            			if(get_field('image'))
            			{
            				?><img src="<?=get_field('image')?>" alt="coreplus"><?php
            			}
        			?>
    			</div>
    			
    		</div>

            </div><!-- #content -->
        </div><!-- #primary -->
    </div>
</div>