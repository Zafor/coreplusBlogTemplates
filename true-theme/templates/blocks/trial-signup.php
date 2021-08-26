<div class="trial-signup-block layout-block layout-block--colour-orange layout-block--padded">
    <div class="container">

        
        <div class="trial-signup-block__form">
            <h2 class="text-center"><?=get_field('trial_form_title', 'option')?></h2>
            <?=get_field('trial_form_description', 'option')?>


            <?=do_shortcode('[contact-form-7 id="12671" title="Trial Form"]') ?>
        </div>

    </div>
</div>

<script type="text/javascript">
    document.addEventListener( 'wpcf7mailsent', function( event ) {
       	if ( '12654' == event.detail.contactFormId ) {
            ga('send', 'event', 'KKfirsttimesignuponhomepage', 'submission', 'form');
        }
    }, false );
</script>