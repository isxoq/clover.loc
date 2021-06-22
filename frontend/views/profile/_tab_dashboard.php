<?php
/*
 * @author Shukurullo Odilov
 * @date 17.05.2021, 10:43
 */


?>


<p class="mb-0">
    Hello <span><?= Yii::$app->user->identity->username ?></span>
    (not <span>User</span> ?

<form action="<?= to(['site/logout']) ?>" method="get">

    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
           value="<?= Yii::$app->request->csrfToken ?>">
    <button type="submit" class="btn btn-link btn-sm"><?= t('Log out') ?></button>
</form>
)
</p>
<p class="mb-8">
    From your account dashboard you can view your <a href="#orders"
                                                     class="link-to-tab text-primary">recent
        orders</a>, manage your shipping and billing
    addresses,<br>and edit your password and account details</a>.
</p>
<a href="<?= to(['/']) ?>" class="btn btn-dark btn-rounded"><?= t('go to shop') ?><i
        class="d-icon-arrow-right"></i></a>
