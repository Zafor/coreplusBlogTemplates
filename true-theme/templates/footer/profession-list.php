<div class="site-footer__professions" data-control="profession-selector">
    <h5 class="type--medium-bold profession-selector__heading text-center" data-profession-trigger>
        <?=do_shortcode(get_field('your_professions_title', 'option')) ?>    
    </h5>
    
    <?=View::make('profession-picker/popup')?>
</div>