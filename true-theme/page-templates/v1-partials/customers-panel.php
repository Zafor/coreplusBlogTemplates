<?php
	$currentTerm = get_queried_object();
	$customers = TrueCustomer::getCustomersByProfession($currentTerm->term_id);

	if(count($customers) > 0)
	{
		global $stepCount;
		$stepCount++;
		?>
		<div class="professions-panel customers customer-sublisting">
			<h3 class="section-title"><?=$currentTerm->name?>s that are using coreplus</h3>
			<ul>
				<?php
					global $post;
					$loop_counter = 1;
					foreach($customers as $customer)
					{
						$post = $customer;
						setup_postdata($post);
						?>
						<li<?php if($loop_counter % 3 == 0) echo ' class="third"'?>>
							<div class="image-holder">
								<?php
									$image = get_field('logo', $customer);
									if($image) 
									{
										?>
										<div class="inner-image-holder"><img  alt="<?=$image['alt']?>" title="<?=$image['title']?>" src="<?=$image['url']?>"></div>
										<?php
									}
								?>
							</div>
							<h2><?php echo get_the_title(); ?></h2> 
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