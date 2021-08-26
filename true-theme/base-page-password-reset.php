<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MZ4462"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

  <!--[if lt IE 9]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

    <?php
        do_action('get_header');
    ?>

    <div class="wrap" role="document">
        <main class="main" role="main">
            <?php include roots_template_path(); ?>
        </main><!-- /.main -->
    </div><!-- /.wrap -->

    <?php if (Config::isLocal()): ?>
        <script>document.write('<script src="http://'
            + (location.host || 'localhost').split(':')[0]
            + ':35729/livereload.js?snipver=1"></'
            + 'script>')</script>
    <?php elseif (Config::isProduction()): ?>

        <script type="text/javascript">
            // start Function to load external scripts without block the page to load
            function loadScript( url, callback ) {
                    var script = document.createElement( "script" )
                    script.type = "text/javascript";
                    script.async = true;
                    if(script.readyState) {  //IE
                    script.onreadystatechange = function() {
                        if ( script.readyState === "loaded" || script.readyState === "complete" ) {
                        script.onreadystatechange = null;
                        callback();
                        }
                    };
                    } else {  //Others
                    script.onload = function() {
                        callback();
                    };
                    }

                    script.src = url;
                    document.getElementsByTagName( "head" )[0].appendChild( script );
                }
            // end Function to load external scripts without block the page to load

            // start hotjar
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:121859,hjsv:5};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
            // end hotjar

            (function() {
                // Start intercom
                var APP_ID = "tevza1x9";
                window.intercomSettings = {
                    app_id: APP_ID
                };
                (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/tevza1x9';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
            })();


        </script>

        <script type="text/javascript">
        adroll_adv_id = "GWACYHNB7BHVRCEQSB4NQO";
        adroll_pix_id = "WJHJ7QZGUZEU5HDXIRETSF";
        (function () {
            var _onload = function(){
                if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
                if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
                var scr = document.createElement("script");
                var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
                scr.setAttribute('async', 'true');
                scr.type = "text/javascript";
                scr.src = host + "/j/roundtrip.js";
                ((document.getElementsByTagName('head') || [null])[0] ||
                    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
            };
            if (window.addEventListener) {window.addEventListener('load', _onload, false);}
            else {window.attachEvent('onload', _onload)}
        }());
        </script>

    <?php endif; ?>
</body>
</html>
