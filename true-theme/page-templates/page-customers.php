<?php
/**
 * Template Name: Customers
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
            <div class="customer-carosel">
                <ul class="customer-slider">
                    <?php
                    
            		$query = new WP_Query( array('post_type' => 'customer',
            		                              'orderby' => 'meta_value_num',
                                                  'meta_key' => 'sort_order',
                                                  'order' => 'ASC',
            		                              'numberposts' => -1, 'posts_per_page' => -1 ));
            		if( $query->have_posts() ):
                    	while ( $query->have_posts() ):
            				$query->the_post();
            				if(get_field('display_in_banner')):
            				?>
            				<li>
            					<div class="lhs">
                					<h2><?php echo get_the_title(); ?></h2> 
                					<div class="entry-content">
                						<?php
                							$banner_text = get_field('banner_text');
                							if ($banner_text):
                								echo $banner_text;
                							else:
                								the_field('sub_listing_text');
                							endif;
                						?>
                					</div>
            					</div>
            					<div class="rhs">
            					    <div class="image-container">
            					        <div class="image-container-inner">
            					            <div class="image-container-table">
                					            <div class="image-container-content">
                            						<?php
                            							$image = get_field('banner_image');
                            							if($image): ?>
                            							<img  alt="<?=$image['alt']?>" title="<?=$image['title']?>" src="<?=$image['sizes']['customer-banner']?>">
                            							<?php else: ?>
                            								<img  alt="Banner Placeholder Image" title="Banner Placeholder Image" src="<?=TrueLib::getImageUrl('placeholder-1.jpg');?>">
                            							<?php endif; ?>
                        						</div>
                    						</div>
                						</div>
            						</div>
            					</div>
            				</li>
            				<?php
            				endif; /* If get field */
                        endwhile;
                        wp_reset_postdata();   
                    endif;
            		?>
                </ul>
            </div> <!-- customer carosel -->
            <div class="clear-fixer-div"></div>
            <div id="content" class="customer-sublisting" role="main">
            <ul>
            
            <?php
            $query = new WP_Query( array(   'post_type' => 'customer',
                                            'orderby' => 'meta_value_num',
                                            'meta_key' => 'sort_order',
                                            'order' => 'ASC',
                                            'numberposts' => -1, 'posts_per_page' => -1 ));
    		
    		if( $query->have_posts() ):
    		
    		    $loop_counter = 1;
            	while ( $query->have_posts() ):
    				$query->the_post();

    				if(get_field('show_in_listing')):
                        ?>
                        <li <?php if($loop_counter % 3 == 0) echo ' class="third"'?>>


        					<div class="image-holder">
        					<?php
        					$image = get_field('logo');
        						if($image):
        						?>
        						<div class="inner-image-holder"><img  alt="<?=$image['alt']?>" title="<?=$image['title']?>" src="<?=$image['url']?>"></div>
        						<?php
        						endif;
        					?>
        					</div>
    					   <h2><?php echo get_the_title(); ?></h2> 
        					<?php 
        					   $short_description = get_field('sub_listing_text');
            					if($short_description):
            						?><div class="entry-content"><?php echo $short_description; ?></div><?php
            					endif;
        					?>
        				</li>
    				    <?php

    				$loop_counter++;
    				endif;
                endwhile;
                wp_reset_postdata();   
            endif;
    		?>
    		</ul>
            </div> <!-- id="content" role="main" -->
        </div> <!-- id="primary" class="site-content -->
    </div><!-- id="main" class="wrapper" -->
</div>
