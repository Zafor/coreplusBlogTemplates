<div class="tabs-wrapper-container">
    <div class="tabs-wrapper">
        <div class="wrapper">
            <div class="list-holder">
                <ul class='main-nav-ul'>
                    <?php
                        global $post;
                        $tabCounter = 1;
                        foreach($tabs as $post) {
                            setup_postdata($post); 
                            $class = '';
                            if($tabCounter == 1) {
                                $class = 'tight';
                            } else if($tabCounter == count($tabs)) {
                                $class = 'tight';
                            } else if($tabCounter % 2) {
                                $class = 'tight';
                            }
                            
                            if($currentTab->ID == get_the_id()) {
                                $class .= ' active';
                            }
                            
                            ?>
                            <li class='main-nav-li <?php echo $class?>'>
                                <a href="<?php echo get_permalink()?>"><span><?php the_title()?></span></a>
                            </li>
                            <?php
                            $tabCounter++;
                        } ?>
                </ul>
            </div>
        </div>
    </div>
</div>