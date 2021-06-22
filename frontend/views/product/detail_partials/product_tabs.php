<?php
/*
 * @author Shukurullo Odilov
 * @date 15.05.2021, 9:57
 */

/* @var $this \yii\web\View */
/* @var $product \frontend\models\Product */

$tabs = [];

if ($product->description) {
    $tabs['description'] = t('Description');
}

$characterAssigns = $product->getActiveCharacterAssigns()
    ->joinWith('character', false)
    ->with(['character' => function ($query) {
        return $query->forceLocalized();
    }])
    ->andWhere(['character.status' => 1])
    ->asArray()
    ->forceLocalized()
    ->all();

if (!empty($characterAssigns) || $product->brand) {
    $tabs['additional'] = t('Additional information');
}

?>

<?php if (!empty($tabs)): ?>


    <div class="tab tab-nav-simple product-tabs mt-2 mb-4">
        <ul class="nav nav-tabs justify-content-center" role="tablist">

            <?php $active = true; ?>
            <?php foreach ($tabs as $key => $label): ?>

                <li class="nav-item">
                    <a class="nav-link <?= $active ? 'active' : '' ?>"
                       href="#product-tab-<?= $key ?>"><?= $label ?></a>
                </li>
                <?php $active = false; ?>
            <?php endforeach; ?>

        </ul>
        <div class="tab-content">

            <?php $active = true; ?>
            <?php foreach ($tabs as $key => $label): ?>
                <div class="tab-pane <?= $active ? 'active' : '' ?>" id="product-tab-<?= $key ?>">
                    <div class="row mt-6">

                        <?php if ($key == 'description'): ?>
                            <?= Yii::$app->formatter->asHtml($product->description) ?>
                        <?php elseif ($key == 'additional'): ?>

                        <?= $this->render('_tab_additional', [
                                'product' => $product,
                                'characterAssigns' => $characterAssigns,
                            ]) ?>

                        <?php endif ?>
                    </div>
                </div>
                <?php $active = false; ?>
            <?php endforeach; ?>

        </div>
    </div>
<?php endif ?>
