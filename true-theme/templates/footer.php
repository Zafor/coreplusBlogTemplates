<footer class="site-footer content-info tw-relative tw-z-40" role="contentinfo">
    <div class="layout-block layout-block--padded layout-block--padding-bottom-medium">
        <div class="container">
            <div class="site-footer__row">
                <!-- Profession -->
                <?=View::make('footer/profession-list') ?>
            </div>

            <div class="site-footer__row">
                <!-- Top Row -->
                <?=View::make('footer/footer-nav') ?>
            </div>

            <div class="site-footer__row">
                <!-- Slider -->
                <?=View::make('footer/slider') ?>
            </div>

            <!-- Footer Copyright -->
            <div class="text-center">
                <div class="site-footer__copy">
                    <?=TrueLib::getFooterCopyright() ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
  // Set the options globally
  // to make LazyLoad self-initialize
  window.lazyLoadOptions = {
    elements_selector: ".lazy, picture > img"
  };
  // Listen to the initialization event
  // and get the instance of LazyLoad
  window.addEventListener(
    "LazyLoad::Initialized",
    function (event) {
      window._lazy = event.detail.instance;
    },
    false
  );
</script>

<script
  async
  src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@16.1.0/dist/lazyload.min.js"
></script>
