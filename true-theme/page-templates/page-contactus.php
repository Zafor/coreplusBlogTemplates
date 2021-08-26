<?php
/**
 * Template Name: Contact Us
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

                <!-- Contact Left -->
            	<div class="contact_col_left">
            		<div class="contact-inner">
            			<h3 class="sub-title"><?=get_field('contact_form_title')?></h3>
            			<?=do_shortcode('[contact-form-7 id="713" title="Contact form 1"]')?>
            		</div>
            	</div>

                <!-- Contact Right -->
            	<div class="contact_col_right last">
            		<div class="contact-inner">

            			<!-- support -->
            			<div class="contact-details support">
            				<h3 class="section-title">Support</h3>
            				<div class="entry-content">
            					<?=get_field('support_section')?>
            				</div>
            			</div>

            			<!-- email -->
            			<div class="contact-details">
            				<h3 class="section-title">Email</h3>
            				<div class="entry-content">
            					<?=get_field('email_section')?>
            				</div>
            			</div>

            			<!-- phone -->
            			<div class="contact-details">
            				<h3 class="section-title">Phone</h3>
            				<div class="entry-content">
            					<?=get_field('phone_section')?>
            				</div>
            			</div>

            			<!-- mail -->
            			<div class="contact-details">
            				<h3 class="section-title">Want to send us a present through mail?</h3>
            				<div class="entry-content">
            					<?=get_field('mail_section')?>
            				</div>
            			</div>

            			<?php /**
            			<!-- headoffice -->
            			<div class="contact-details">
            				<h3 class="section-title">Head Office</h3>
            				<div class="entry-content">
            					<?=get_field('ho_section')?>
            				</div>
            			</div>
                         */
                         ?>

            		</div>
            	</div>
            	<div class="clear"></div>
            </div>
        </div>
<br>&nbsp;</br>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12604.8095795937!2d144.968662!3d-37.8321474!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf31ed669d83f1fa4!2scoreplus!5e0!3m2!1sen!2sau!4v1568267368476!5m2!1sen!2sau" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </div>
</div>
