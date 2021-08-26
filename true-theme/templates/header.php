
<?php if(is_front_page()): ?>
<?=View::make('profession-picker/top-bar')?>
<?php endif; ?>

<div class="header-container" data-control="site-header">
	<header class="header navbar navbar-fixed-top header--collapsed" role="banner">

		<!-- Nav Bar -->
		<div class="header-nav">
			<!-- Header Search -->
			<form class="header-search" action="/">
				<div class="input-group">
					<span class="input-group-btn">
				        <button class="header-search__submit-search" type="submit">
				        	<span class="moon-icon--search_icon"></span>
				        </button>
				    </span>
					<input type="text" name="s" class="form-control" placeholder="Search" value="<?=esc_attr(get_query_var('s'))?>">
					<span class="input-group-btn">
				        <button class="header-search__close-search" type="button">
				        	<span class="moon-icon--close"></span>
				        </button>
				    </span>
			   	</div>
			</form>
            
            
            <div class="header-nav__center">
                <nav class="collapse navbar-collapse" role="navigation">
                    <?php
                    if (has_nav_menu('primary_navigation')) :
                        wp_nav_menu([
                            'theme_location' => 'primary_navigation', 
                            'menu_class' => 'nav navbar-nav',
                            'link_before' => '<span>',
                            'link_after' => '</span>'
                        ]);
                    endif;
                    ?>
                </nav>
            </div>
                        
			<!-- Main Navigation -->
			<div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 col-lg-6">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?php echo home_url(); ?>/">
                                <img alt="coreplus" src="<?=TrueLib::getImageURL('logo.png')?>" class="retina-image">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <div class="header-nav__right">
                            <a class="btn btn--colour-orange btn--no-shadow hidden-xs header-nav__trial-button" href="<?=get_field('header_trial_link', 'option')?>"><?=get_field('header_trial_button_text', 'option')?></a>

                            <a class="btn btn--colour-orange-border btn--no-shadow hidden-xs" href="<?=COREPLUS_LOGIN_URL?>" target="_blank">Login</a>

                            <button type="button" class="header__burger-menu burger-menu" data-nav-toggle="nav-sidebar">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>								
			</div>
		</div>
	</header>
</div>