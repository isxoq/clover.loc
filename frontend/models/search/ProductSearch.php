<?php

namespace frontend\models\search;

use Yii;
use frontend\models\Product;
use yii\data\ActiveDataProvider;

class ProductSearch
{

    public function search($query = null, $defaultPageSize = 12)
    {
        if ($query == null) {
            $query = Product::find()->active();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => $defaultPageSize,
            ],
            'sort' => [
                'attributes' => [
                    'latest' => [
                        'asc' => ['product.created_at' => SORT_DESC],
                        'desc' => ['product.created_at' => SORT_DESC],
                    ],
                    'price-high' => [
                        'asc' => ['product.price' => SORT_ASC],
                        'desc' => ['product.price' => SORT_ASC]
                    ],
                    'price-low' => [
                        'asc' => ['product.price' => SORT_DESC],
                        'desc' => ['product.price' => SORT_DESC]
                    ],

                    'name' => [
                        'asc' => ['product_lang.name' => SORT_ASC],
                        'desc' => ['product_lang.name' => SORT_DESC]
                    ]

                ]
            ]
        ]);

        $request = Yii::$app->request;

        $query->andFilterWhere(['>=', 'product.price', $request->get('min-price')]);
        $query->andFilterWhere(['<=', 'product.price', $request->get('max-price')]);

        return $dataProvider;

    }


}