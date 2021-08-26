<?php
    if(trim(get_field('page_title')) != '')
    {
        ?>
        <div class="page-statement-container">
            <div class="page-statement-inner">
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
        </div>
        <?php
    }
