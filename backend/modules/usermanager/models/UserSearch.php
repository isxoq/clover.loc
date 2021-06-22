<?php

namespace backend\modules\usermanager\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\usermanager\models\User;

class UserSearch extends User
{

    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'code', 'verify_time', 'family', 'experience', 'salary'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'phone', 'first_name', 'last_name', 'address', 'wish_list', 'work', 'profession', 'passport_front', 'passport_back', 'passport_with_person', 'card_number', 'card_expiry', 'card_phone'], 'safe'],
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
            $query = User::find();
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
            'type' => \common\models\User::STAFF,
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'code' => $this->code,
            'verify_time' => $this->verify_time,
            'family' => $this->family,
            'experience' => $this->experience,
            'salary' => $this->salary,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'wish_list', $this->wish_list])
            ->andFilterWhere(['like', 'work', $this->work])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'passport_front', $this->passport_front])
            ->andFilterWhere(['like', 'passport_back', $this->passport_back])
            ->andFilterWhere(['like', 'passport_with_person', $this->passport_with_person])
            ->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'card_expiry', $this->card_expiry])
            ->andFilterWhere(['like', 'card_phone', $this->card_phone]);
        return $dataProvider;
    }
}
