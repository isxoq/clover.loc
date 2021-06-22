<?php

namespace backend\modules\postmanager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\postmanager\models\Post;

class PostSearch extends Post
{

    public function rules()
    {
        return [
            [['id', 'status', 'published_at', 'category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['slug', 'image', 'small_image', 'title'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($query = null, $defaultPageSize = 20, $params = null)
    {

        if ($params == null) {
            $params = Yii::$app->request->queryParams;
        }
        if ($query == null) {
            $query = Post::find();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => $defaultPageSize,
            ],
            'sort' => [
                'defaultOrder' => [
                    'published_at' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'published_at' => $this->published_at,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->joinWith('translation');

        $query->andFilterWhere(['like', 'post_lang.title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'small_image', $this->small_image]);
        return $dataProvider;
    }
}
