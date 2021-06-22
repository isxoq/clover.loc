<?php

namespace backend\modules\charactermanager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\charactermanager\models\Character;

class CharacterSearch extends Character
{

    public function rules()
    {
        return [

            [['name_uz', 'name_ru'], 'string'],

            [['id', 'sort_order', 'group_id', 'status'], 'integer'],
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
            $query = Character::find()->joinWith("translations");
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
            'group_id' => $this->group_id,
            'status' => $this->status,
        ]);



        $query->andFilterWhere(['like', 'character_lang.name', $this->name_uz]);
        $query->orFilterWhere(['like', 'character_lang.name', $this->name_ru]);

        return $dataProvider;
    }
}
