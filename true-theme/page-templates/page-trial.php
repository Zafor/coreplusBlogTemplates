<?php
/**
 * Template Name: Trial
 *
 */
?>
<div class="v1-theme">
    <div id="main" class="wrapper">
        <?php createTrueBreadcrumb()?>
    </div>
</div>

<div class="layout-block--padding-bottom-medium layout-block--colour-white">
    <div class="container">
        <div class="layout-card">
            <?php
                $contactForm = get_field('contact_form');
            ?>
            <div class="trial-form-wrapper">
                <?php if (isset($_GET['reason'])): ?>
                    <?php
                    switch ($_GET['reason']) {
                        case '2':
                            $titleHtml = 'Something went wrong';
                            $bodyHtml = 'The email address entered is invalid. Please try again.';
                            break;
                        case '3':
                            $titleHtml = 'An email has been sent';
                            $bodyHtml = 'You already have a trial account with coreplus. A password reset link has been sent to you.';
                            break;
                        case '4':
                            $titleHtml = 'Something went wrong';
                            $bodyHtml = 'It seems like an error has occurred with setting up your account. We’ve automatically been alerted to the problem. Please try that again.';
                            break;
                    };
                    ?>
                    <h3 class="text-center type--contact-title type--colour-orange">
                        <?php echo($titleHtml)?>
                    </h3>
                    <div class='trialSent trial-description entry-content'>
                        <?php echo($bodyHtml)?>
                    </div>
                    <div class="text-right layout-block__button-spacer">
                        <a href="<?=get_the_permalink() ?>" class="btn btn--colour-orange btn--small-shadow">
                            Go Back
                        </a>
                    </div>
                <?php else: ?>
                    <?=do_shortcode('[contact-form-7 id="' . $contactForm . '"]')?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener( 'wpcf7mailsent', function( event ) {
            var formID = event.detail.contactFormId;
            if (formID == <?=$contactForm?>) {
                ga('send', 'event', 'KKfirsttimesignup', 'submission', 'form');
            }
        }, false );
        document.addEventListener( 'wpcf7submit', function( event ) {
            if (event.detail.apiResponse.redirect_url) {
                window.location.href = event.detail.apiResponse.redirect_url
            }
        }, false );
    </script>
</div>
