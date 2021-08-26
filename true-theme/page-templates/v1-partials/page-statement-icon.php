<?php
    if(trim(get_field('page_title')) != '')
    {
        ?>
        <div class="page-statement-container icon">
            <div class="page-statement-inner">
                <div class="page-statement-left">
                    <?php echo TrueLib::getACFImage('page_icon')?>
                </div>
                <div class="page-statement-right">
                    <h3><?=get_field('page_title')?></h3>
                    <?php
                        if(get_field('statement') != '')
                        {
                            ?>
                            <div class="page-statement"><?=get_field('statement')?></div>
                            <?php
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?php
    }
