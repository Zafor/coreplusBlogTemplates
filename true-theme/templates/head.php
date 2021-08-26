<!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html class="no-js ie ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title('|', true, 'right'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <script>
        (function(d) {
            var config = {
            kitId: 'cnp1rhl',
            scriptTimeout: 3000,
            async: true
            },
            h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
        })(document);
        </script>

		<link rel="icon" href="<?= TrueLib::getImageURL('favicon.png') ?>">
		<?php wp_head(); ?>
		<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
		<!--[if IE 8]>
		<script type="text/javascript" src="<?= bloginfo('template_url') ?>/assets/vendor/respond.min.js"></script>
        <![endif]-->

		<script>
			window.corplus_app_url = 'https://coreplus.com.au/intracore/redir.html';
		</script>
		<?php if (Config::isProduction()): ?>
    	<?php endif; ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MZ4462');</script>
<!-- End Google Tag Manager -->

<?php // Old theme compatibility for blog, remove after Blog v2 is deployed?>
<style>
.v1-theme .entry-content table tr {
    height: auto;
}
.v1-theme .entry-content table td h3 {
    font-size: 22px;
    font-weight: 500;
    color: #424242;
}
.v1-theme .entry-content table td h4 {
    font-size: 18px;
    font-weight: 500;
    color: #424242;
}
.v1-theme .entry-content table td h5 {
    font-size: 16px;
}
.v1-theme .entry-content table td p,
.v1-theme .entry-content table td {
    font-size: 16px;
}
.row.row--flex {
    display: flex;
    flex-wrap: wrap;
}
</style>

</head>
