<?php

namespace backend\modules\productmanager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\productmanager\models\Product;

class ProductSearch extends Product
{

    public $productName;

    public function rules()
    {
        return [
            [['id', 'price', 'old_price', 'order_count', 'status', 'created_at', 'updated_at', 'category_id'], 'integer'],
            [['slug','productName'], 'safe'],
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
            $query = Product::find()->joinWith('translation')->with("category");
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
            'product.id' => $this->id,
            'product.price' => $this->price,
            'product.old_price' => $this->old_price,
            'product.order_count' => $this->order_count,
            'product.status' => $this->status,
            'product.created_at' => $this->created_at,
            'product.updated_at' => $this->updated_at,
            'product.category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'product.slug', $this->slug]);
        $query->andFilterWhere(['like', 'product_lang.name', $this->productName]);
        return $dataProvider;
    }
}
