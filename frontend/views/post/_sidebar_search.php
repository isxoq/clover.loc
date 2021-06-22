<?php
use yii\helpers\Url;
?>

<div class="widget widget-search border-no mb-2">
    <form action="<?=Url::to(['post/search']);?>" class="input-wrapper input-wrapper-inline btn-absolute" method="get">
        <input type="text" class="form-control" name="key" autocomplete="off"
               placeholder="<?=Yii::t('app','search in blogs')?>" value="<?=Yii::$app->request->get('key')?>" required/>
        <button class="btn btn-search btn-link" type="submit">
            <i class="d-icon-search"></i>
        </button>
    </form>
</div>
