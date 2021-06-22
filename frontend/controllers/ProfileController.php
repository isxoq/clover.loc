<?php


namespace frontend\controllers;

use backend\modules\ordermanager\models\Order;
use common\models\User;
use frontend\models\PersonalDataForm;
use Yii;
use soft\helpers\SiteHelper;
use soft\web\SoftController;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\UploadedFile;


class ProfileController extends SoftController
{
    public function init()
    {
        SiteHelper::setLanguage();
        parent::init();
    }

    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]

        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionWishlist()
    {
        return $this->render('wishlist', ['wishedProducts' => Yii::$app->user->identity->wishedProducts]);
    }

    public function actionAccount()
    {

        $query = Order::find()->andWhere(['user_id' => user('id')]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        $personalDataModel = new PersonalDataForm([
            'first_name' => Yii::$app->user->identity->first_name,
            'last_name' => Yii::$app->user->identity->last_name,
            'address' => Yii::$app->user->identity->address,
            'email' => Yii::$app->user->identity->email,
        ]);

        if ($personalDataModel->load(Yii::$app->request->post())) {

            if ($personalDataModel->save()) {
                $this->setFlash('user_success', t('Your personal data has been successfully updated'));
            } else {
                $this->setFlash('user_error', t('An error occured while saving your personal data'));
            }

        }

        return $this->render('account', [
            'personalDataModel' => $personalDataModel,
            'models' => $models,
            'pages' => $pages
        ]);
    }

    public function actionPersonal()
    {

        $user = User::findOne(user('id'));

        if ($user->load(Yii::$app->request->post())) {

            if (UploadedFile::getInstance($user, 'passport_front') != null) {
                $user->passport_front = UploadedFile::getInstance($user, 'passport_front');
                $user->savePassportFront();
            }

            if (UploadedFile::getInstance($user, 'passport_back') != null) {
                $user->passport_back = UploadedFile::getInstance($user, 'passport_back');
                $user->savePassportBack();
            }

            if (UploadedFile::getInstance($user, 'passport_with_person') != null) {
                $user->passport_with_person = UploadedFile::getInstance($user, 'passport_with_person');
                $user->savePassportWithPerson();
            }

            if ($user->validate()) {
                $user->save();
                return $this->redirect(['shop/loan']);
            }

        }

        return $this->render('personal', [
            'user' => $user
        ]);
    }

}