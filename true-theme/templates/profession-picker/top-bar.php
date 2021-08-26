<!-- Choose your profession -->
<div class="profession-selector">

    <?php if(HomeContent::isDefault()): ?>
    <!-- Content -->
    <div class="profession-selector__content">
        <h4 class="type--medium-bold profession-selector__heading">
            <?=do_shortcode(get_field('choose_experience_text', 'option'))?>
        </h4>

        <div class="profession-selector__close">
            <i class="moon-icon--close"></i>
        </div>
    </div>
    <?php endif; ?>
</div>