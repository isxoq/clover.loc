<?php


namespace backend\controllers;

use Yii;
use soft\web\SoftController;
use yii\helpers\Json;

class SettingsController extends SoftController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }


    public function actionContactInfo()
    {

        if ($this->post()) {

            if (Yii::$app->acf->save($this->post())) {
                $this->setFlash('success', "Ma'lumotlar muvaffaqiyatli saqlandi!");
            } else {
                $this->setFlash('error', "Ma'lumotlarni saqlashda xatolik yuz berdi!");
            }

        }

        return $this->render('contact_info');
    }


    public function actionAboutUsPage()
    {


//        $a = ['editorOptions' => [
//            'preset' => 'full',
//            'allowedContent' => '*(*)',
//        ]];
////
//        $a = [
//            'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
//                'preset' => 'full',
////                'allowedContent' => '*(*)',
//            ]),
//        ];


        if ($this->post()) {

            if (Yii::$app->acf->save($this->post())) {
                $this->setFlash('success', "Ma'lumotlar muvaffaqiyatli saqlandi!");
            } else {
                $this->setFlash('error', "Ma'lumotlarni saqlashda xatolik yuz berdi!");
            }

        }

        return $this->render('about_us_page');


    }
}