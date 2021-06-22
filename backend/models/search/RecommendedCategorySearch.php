<?php
/**
 * @author Ulug'bek
 * @date 18.05.2021, 11:54
 */

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RecommendedCategory;

class RecommendedCategorySearch extends RecommendedCategory
{

    public function rules()
    {
        return [
            [['id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['image', 'url'], 'safe'],
            [['text1'],'string'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($query=null, $defaultPageSize = 20, $params=null)
    {

        if($params == null){
            $params = Yii::$app->request->queryParams;
        }
        if($query == null){
            $query = RecommendedCategory::find();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                    'defaultPageSize' => $defaultPageSize,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'text1', $this->text1])
            ->andFilterWhere(['like', 'url', $this->url]);
        return $dataProvider;
    }
}
