<?php
	$currentTerm = get_queried_object();
	$addons = TrueAddon::getAddonsByProfession($currentTerm->term_id);

	if(count($addons) > 0)
	{
		global $stepCount;
		$stepCount++;
		?>
		<div class="professions-panel customers customer-sublisting">
			<h3 class="section-title">Add-ons for <?=$currentTerm->name?>s</h3>
			<ul>
				<?php
					$loop_counter = 1;
					$addonsURL = get_permalink(ADDONS_PAGE);
					foreach($addons as $addon)
					{
						$post = $addon;
						setup_postdata($post);
						?>
						<li<?php if($loop_counter % 3 == 0) echo ' class="third"'?>>
							<a href="<?=$addonsURL?>">
								<div class="image-holder">
									<?php
										$image = get_field('company_logo', $addon->ID);
										if($image) 
										{
											?>
											<div class="inner-image-holder"><img  alt="<?=$image['alt']?>" title="<?=$image['title']?>" src="<?=$image['url']?>"></div>
											<?php
										}
									?>
		    					</div>

		    					<h2><?php echo get_the_title(); ?></h2>
	    					</a>
						</li>
						<?php

						$loop_counter++;
					}
					wp_reset_postdata(); 
				?>
			</ul>
		</div>
		<?php	
	}
?>

