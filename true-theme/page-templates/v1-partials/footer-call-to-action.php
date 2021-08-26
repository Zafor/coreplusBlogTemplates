
<!-- Footer Call to Action -->
<div class="footer-call-to-action">
 	<div class="wrapper">
 	    <img alt='' src="<?=TrueLib::getImageUrl('footer-callout-banner.png'); ?>">
 		<div class="heading"><p><?=get_field('heading','options')?></p></div>
 		<?php $button_text = get_field('button_text', 'options'); ?>
 		<div class="button-holder">
 		    <a class="flat-button" href="<?=get_field('button_link_location','options')?>" title="<?=$button_text?>"><?=$button_text ?></a>
 		</div>
    </div>
</div>
