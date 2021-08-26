<!-- Page Title -->
    <?php if ($title != '' || count($breadcrumb) > 0): ?>
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title"><?= $title ?></h3>


                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo Route::generateURL()?>">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <?php foreach ($breadcrumb as $key => $value): ?>
                        <li>
                            <?php if (is_array($value)): ?>
                                <?php if (count($value) == 1): ?>
                                    <a href="<?php echo Route::generateURL($value[0])?>"><?= $key ?></a>
                                <?php elseif(count($value) == 2): ?>
                                    <a href="<?php echo Route::generateURL($value[0], $value[1])?>"><?= $key ?></a>
                                <?php elseif(count($value) == 3): ?>
                                    <a href="<?php echo Route::generateURL($value[0], $value[1], $value[2])?>"><?= $key ?></a>
                                <?php endif; ?>
                            <?php else: ?>
                            <a href="<?php echo Route::generateURL($value)?>"><?= $key ?></a>
                            <?php endif; ?>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <?php endforeach ?>
                        <li>
                            <?= $title ?>
                        </li>
                    </ul>

            </div>
        </div>
    <?php endif ?>