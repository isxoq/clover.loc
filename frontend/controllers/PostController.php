<?php


namespace frontend\controllers;

use backend\modules\postmanager\models\PostCategory;
use soft\helpers\SiteHelper;
use Yii;
use backend\modules\postmanager\models\Post;
use yii\data\ActiveDataProvider;

class PostController extends \yii\web\Controller
{
    public function init()
    {
        SiteHelper::setLanguage();
        parent::init();
    }

    public function actionAll()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->published()->active()->recently(),
            'pagination' => [
                'defaultPageSize' => 4
            ]
        ]);
        return $this->render('all', [
            'dataProvider' => $dataProvider
        ]);

    }

    public function actionCategory($slug = '')
    {

        $category = PostCategory::find()->active()->andWhere(['slug' => $slug])->one();

        if ($category == null) {
            not_found();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->published()->active()->recently()->andWhere(['category_id' => $category->id]),
            'pagination' => [
                'defaultPageSize' => 4
            ]
        ]);
        return $this->render('categoryPosts', [
            'dataProvider' => $dataProvider,
            'category' => $category,
        ]);
    }


    public function actionDetail($slug = '')
    {
        $post = Post::find()
            ->active()
            ->where(['slug' => $slug])
            ->one();


        if (!$post) {

            not_found();
        }
        return $this->render('detail', compact('post'));
    }

    public function actionSearch()
    {

        $search = Yii::$app->request->get('key');

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()
                ->published()
                ->active()
                ->joinWith('translation')
                ->andFilterWhere(['like', 'post_lang.title', $search])
                ->recently(),
            'pagination' => [
                'defaultPageSize' => 1
            ]
        ]);
        if ($dataProvider->models == null) {
            not_found();
        }
        return $this->render('all', [
            'dataProvider' => $dataProvider
        ]);
    }

}