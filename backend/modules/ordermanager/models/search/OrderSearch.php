<?php

namespace backend\modules\ordermanager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ordermanager\models\Order;

class OrderSearch extends Order
{

    public $paymentMethod;
    public $statusLabel;

    public function rules()
    {
        return [
            [['paymentMethod', 'full_name', 'statusLabel'], 'string'],
            [['id', 'user_id', 'payment_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['phone'], 'safe'],
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
            $query = Order::find();
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
            'user_id' => $this->user_id,
            'payment_type' => $this->payment_type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone]);
        $query->andFilterWhere(['like', 'full_name', $this->full_name]);
        return $dataProvider;
    }
}
