<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Faq;

/**
 * @property mixed|null question
 * @property mixed|null asked
 */
class FaqSearch extends Faq
{

    public function rules()
    {
        return [

            [['id', 'status', 'faq_type_id', 'created_at', 'updated_at'], 'integer'],
            [['question','asked'],'string'],
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
            $query = Faq::find();
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

        $query->joinWith('translation');

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'faq_type_id' => $this->faq_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'faq_lang.question', $this->question]);
//              ->andFilterWhere(['like','faq_lang.asked'],$this->asked);

        return $dataProvider;
    }
}
