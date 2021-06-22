<?php

namespace backend\modules\productmanager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\productmanager\models\ProductCharacterAssign;

class ProductCharacterAssignSearch extends ProductCharacterAssign
{

    public function rules()
    {
        return [
            [['id', 'sort_order', 'character_id', 'product_id', 'status'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($query=null, $defaultPageSize = 50, $params=null)
    {

        if($params == null){
            $params = Yii::$app->request->queryParams;
        }
        if($query == null){
            $query = ProductCharacterAssign::find();
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
            'sort_order' => $this->sort_order,
            'character_id' => $this->character_id,
            'product_id' => $this->product_id,
            'status' => $this->status,
        ]);
        return $dataProvider;
    }
}
