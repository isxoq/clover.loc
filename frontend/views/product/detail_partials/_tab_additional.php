<?php
/*
 * @author Shukurullo Odilov
 * @date 15.05.2021, 12:33
 */
/** @var \frontend\models\Product $product */
/** @var array $characterAssigns */

?>
<ul class="list-none">

    <?php if ($product->brand): ?>
        <li><label><?= t('Brand') ?>:</label>
            <p><?= $product->brand->name ?></p>
        </li>
    <?php endif ?>

    <?php foreach ($characterAssigns as $assign): ?>

        <li>
            <label>
                <?= $assign['character']['translation']['name'] ?>:
            </label>
            <p>
                <?= $assign['translation']['value'] ?>
            </p>
        </li>

    <?php endforeach; ?>
</ul>
