<div class="profession-selector-popup">
    <div class="layout-table">
        <div class="layout-table__cell">
            <!-- Dialog -->
            <div class="profession-selector-dialog">
                <!-- Close -->
                <div class="profession-selector-dialog__close">
                    <i class="moon-icon--close"></i> 
                </div>
                <div class="clearfix"></div>


                <div class="profession-selector-dialog__content">
                    
                    <!-- Header -->
                    <div class="profession-selector-dialog__header">
                        <h3 class="type--bold type--colour-dark"><?=get_field('profession_picker_title', 'option') ?></h3>
                    </div>
                    
                    <!-- Choices -->
                    <ul class="profession-selector-dialog__choices">
                        <?php
                            $professions = HomeContent::getProfessionList(); 

                            foreach($professions as $postID => $postName):
                                ?>
                                <li>
                                    <a data-id="<?=$postID?>" 
                                        href="<?=get_the_permalink($postID) ?>" 
                                        <?php if($postID == HomeContent::getPreferredProfession()) { echo 'class="active"'; } ?>>
                                        <?=$postName?>
                                    </a>
                                </li>
                                <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
                
                <div class="profession-selector-dialog__loader">
                    <img alt="Loading" src="<?=TrueLib::getImageURL('svg/white-loader.svg')?>">
                </div>
            </div>
        </div>
    </div>
</div>