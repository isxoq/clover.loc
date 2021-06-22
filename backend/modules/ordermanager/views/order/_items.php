<?php


?>


<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col"><?= t('Product Name') ?></th>
        <th scope="col"><?= t('Product Image') ?></th>
        <th scope="col"><?= t('Product Amount') ?></th>
        <th scope="col"><?= t('Product Price') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;
    foreach ($model->orderItems as $item): ?>
        <tr>
            <th scope="row"><?= $i ?></th>
            <td>
                <a data-pjax="0" target="_blank"
                   href="<?= \soft\helpers\Url::to(['/product-manager/product/view', 'id' => $item->product->id]) ?>"><?= $item->product->name ?></a>
            </td>
            <td><img style="width: 80px;" src="<?= $item->product->getImage() ?>" alt="<?= $item->product->name ?>"></td>
            <td><?= $item->amount ?></td>
            <td><?= Yii::$app->formatter->asSum($item->price) ?></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach ?>
    </tbody>
</table>