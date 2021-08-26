<div class="blog-nav row">
            <div class="blog-nav-items col-lg-9 col-md-12 col-sm-12">
                <a href="https://qa-web.coreplus.com.au/blog/" class="blog-submenu-links same-line-text <?php if (is_page('blog')) echo 'active-navbar'; ?>">All</a>
				<a href="https://qa-web.coreplus.com.au/practice-life/" class="blog-submenu-links same-line-text <?php if (is_page('practice-life')) echo 'active-navbar'; ?>">Practice Life & How Tos</a>
                <a href="https://qa-web.coreplus.com.au/product-releases-blog/" class="blog-submenu-links same-line-text <?php if (is_page('product-releases-blog')) echo 'active-navbar'; ?>">New Releases</a>
                <a href="https://qa-web.coreplus.com.au/add-ons-page/" class="blog-submenu-links same-line-text <?php if (is_page('add-ons-page')) echo 'active-navbar'; ?>">Add-ons</a>
                <a href="https://qa-web.coreplus.com.au/advisers/" class="blog-submenu-links same-line-text <?php if (is_page('advisers')) echo 'active-navbar'; ?>">Industry Experts</a>
				<a href="https://qa-web.coreplus.com.au/digital-health/" class="blog-submenu-links same-line-text <?php if (is_page('digital-health')) echo 'active-navbar'; ?>">Culture</a>
                
            </div>
            <div class="blog-nav-search col-lg-3 col-md-12 col-sm-12" >
				<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="s"></label>
        <input type="text" class="blog-search-input" value="" name="s" id="s" placeholder="Blog Search" /><button type="submit" class="blog-search"><i class="fa fa-search"></i></button>
    </div>
</form>
            </div>
        </div>