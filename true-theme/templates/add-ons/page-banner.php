<div class="top-banner" style="background-color: <?= $bgColor ?>; color: <?= $textColor ?>"
    data-addon-banner
>
    <div class="wrapper">
        <div class="site-content">
            <?php
                if ($line1 != '') {
                    ?>
                    <h2><?=do_shortcode($line1)?></h2>
                    <?php
                }

                if ($line2 != '') {
                    ?>
                    <h1><?=$line2?></h1>
                    <?php
                }

                if ($line3 != '') {
                    ?>
                    <h3><?=$line3?></h3>
                    <?php
                }
            ?>
        </div>
    </div>
</div>