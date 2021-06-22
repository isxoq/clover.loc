<?php

namespace backend\modules\ordermanager\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ordermanager\models\Loan;

class LoanSearch extends Loan
{

    public function rules()
    {
        return [
            [['id', 'user_id', 'product_id', 'loan_price', 'first_payment', 'month', 'created_date', 'status'], 'integer'],
            [['first_name', 'last_name', 'card_number', 'card_expiry', 'card_phone'], 'safe'],
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
            $query = Loan::find();
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
            'product_id' => $this->product_id,
            'loan_price' => $this->loan_price,
            'first_payment' => $this->first_payment,
            'month' => $this->month,
            'created_date' => $this->created_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'card_expiry', $this->card_expiry])
            ->andFilterWhere(['like', 'card_phone', $this->card_phone]);
        return $dataProvider;
    }
}
