<?php

namespace backend\modules\postmanager\models\query;

class PostQuery extends \soft\db\ActiveQuery
{


    public function published()
    {
        return $this->andWhere(['<=', 'published_at', strtotime('now') ]);
    }

    public function recently()
    {
        return $this->orderBy('published_at desc');
    }


}