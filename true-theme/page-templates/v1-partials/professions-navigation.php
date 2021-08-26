<div class="professions-nav-container">

	<h3 class="section-title"><div class="stepnumber">1</div> The industry I work in is...</h3>

	<div class="profession-nav parent-nav">

		<ul>

			<?php

				$categories = TrueAddon::getProfessionsHierarchy();

				$term =	$wp_query->queried_object;



				$isTerm = false;

				if(isset($term->term_id))

				{

					if($term->parent == 0)

					{

						$currentCategory = $term->term_id;

					} else {

						$currentCategory = $term->parent;

					}

					$isTerm = true;

				} else {

					$first = reset($categories);

					$currentCategory = $first['term']->term_id;

				}



				foreach($categories as $topLevel)

				{

					?>

					<li class="<?php if($currentCategory == $topLevel['term']->term_id) echo 'active'?>">

						<a class="parent-link" data-term-id="<?php echo $topLevel['term']->term_id?>" href="<?=esc_url(get_term_link( $topLevel['term'], TrueAddon::$taxName))?>"><?=$topLevel['term']->name?></a>

					</li>

					<?php

				}

			?>

		</ul>

	</div>

	<h3 class="section-title"><div class="stepnumber">2</div> Professions in my practice include...</h3>

	<!-- Child Navigation -->

	<div class="children-nav">

		<?php

			foreach($categories as $topLevel)

			{

				?>

				<div class="profession-nav child-nav-<?=$topLevel['term']->term_id?> <?php if($topLevel['term']->term_id == $currentCategory) echo ' nav-active'?>">

					<ul>

						<?php

							foreach($topLevel['children'] as $profession)

							{

								$current = '';

								if($profession->term_id == $term->term_id)

								{

									$current = 'active';

								}

								?>

								<li class="<?=$current?>">

									<a data-term-id="<?=$profession->term_id?>" href="<?=esc_url(get_term_link( $profession, TrueAddon::$taxName))?>"><?=$profession->name?></a>

								</li>

								<?php

							}

						?>

					</ul>

				</div>

				<?php

			}

		?>

	</div>

</div>