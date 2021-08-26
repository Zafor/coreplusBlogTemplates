<h6 class="type--bold type--color-dark">
    <a href="<?=get_term_link($currentTerm)?>"><?=$currentTerm->name?></a>
</h6>

<div class="site-footer__nav">
    <ul>
		<?php
			$childTerms = get_term_children($currentTerm->term_id, TrueAddon::$taxName);

			foreach($childTerms as $termID):
				$term = get_term_by('id', $termID, TrueAddon::$taxName);
				?>
				<li>
		            <a href="<?=get_term_link($term)?>"><?=$term->name?></a>
		        </li>
		<?php endforeach; ?>
	</ul>
</div>