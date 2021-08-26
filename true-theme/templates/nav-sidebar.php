<div class="floating-sidebar nav-sidebar scrollable" 
    data-nav-sidebar=""
    data-nav-id="nav-sidebar">
    <div class="floating-sidebar__content-wrap">
        <div class="floating-sidebar__content">
            <div class="floating-sidebar__content-inner">
                <div class="floating-sidebar__header">
                    <a class="navbar-brand" href="<?=home_url(); ?>/">
                        <img alt="coreplus"
                            src="<?=TrueLib::getImageURL('logo.png')?>"
                            class="retina-image">
                    </a>

                    <button type="button"
                        class="floating-sidebar__burger-menu burger-menu open"
                        data-nav-toggle="nav-sidebar">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="floating-sidebar__menu">
                    <div class="floating-sidebar__menu-inner">
                        <?php
                            if (has_nav_menu('primary_navigation')) :
                                wp_nav_menu([
                                    'theme_location' => 'primary_navigation', 
                                    'menu_class' => 'nav',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>'
                                ]);
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="floating-sidebar__footer">
            <a class="btn btn--colour-orange btn--no-shadow header-nav__trial-button"
                href="<?=get_field('header_trial_link', 'option')?>">
                Free Trial
            </a>
            <a class="btn btn--colour-orange-border btn--no-shadow" 
                href="<?=COREPLUS_LOGIN_URL?>" target="_blank">
                Login
            </a>
        </div>    
    </div>
</div>
<div class="floating-sidebar__overlay"></div>