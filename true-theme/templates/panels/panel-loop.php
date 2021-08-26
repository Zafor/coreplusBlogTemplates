<?php
if (!isset($key)) {
    $key = 'panels';
}

if(!have_rows($key)):
    return;
endif;
?>

<div class="site-blocks">
    <?php foreach(get_field($key) as $panel): the_row();
        echo View::make('panels/' . get_row_layout(), ['panel' => $panel]);
    endforeach; ?>
</div>
