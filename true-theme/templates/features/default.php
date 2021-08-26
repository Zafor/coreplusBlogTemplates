<?php
    if (!get_field('content')):
        return;
    endif;

    $contentBlocks = get_field('content');
    $layoutType = get_field('layout_type');
?>

<div class="features-tab active features-tab--layout-<?=strtolower($layoutType)?>">
    <div class='entry-content page-description'>
        <?=get_field('page_description')?>    
    </div>
    <div class='accordionTab' data-mode="<?=$layoutType?>">
        <?=view('features/sidenav', [
            'layoutType'        => $layoutType,
            'contentBlocks'     => $contentBlocks,
            'footerNavLink'     => get_field('navbar_footer_link')
        ]) ?>
        <!-- Tab Content -->
        <div class="resp-tabs-container">
            <?php
                /*Create tab div field for subsection*/
                $inner_tab_counter = 1;
                foreach ($contentBlocks as $content):
                    $layout_class = $content['layout'];
                    $selected = '';
                    if ($inner_tab_counter == 1 || $layoutType == 'ADDON'):
                        $selected = ' resp-tab-content-active';
                    endif;
                    ?>
                    <div class="<?=$selected?>" data-location="inner_tab" data-current-tab="false">
                        <?php
                            $sections = $content['sections'];
                        ?>
                        <?php if ($layoutType == 'ADDON'): ?>
                        <h3 class="features-tab__section-heading">
                            <?=$content['title']?>
                        </h3>
                        <?php endif; ?>
                        <?php foreach ($sections as $section): ?>
                            <div class="features-section">
                                <?php if ($content['layout'] == 'image-ext'): ?>
                                    <?=view('features/image-extended', ['section' => $section]) ?>
                                <?php elseif ($content['layout'] == 'image-left'): ?>
                                    <?=view('features/image-left', ['section' => $section]) ?>
                                <?php elseif ($content['layout'] == 'image-rhs'): ?>
                                    <?=view('features/image-right', ['section' => $section]) ?>
                                <?php elseif ($content['layout'] == 'image-bottom'): ?>
                                    <?=view('features/image-bottom', ['section' => $section]) ?>
                                <?php endif; ?>
                                <div class="clear"></div>
                            </div>
                        <?php endforeach;  ?>
                    </div><!-- end tab field -->
                    <?php
                    $inner_tab_counter++;
                endforeach;
            ?>
        </div>
    </div>
</div>