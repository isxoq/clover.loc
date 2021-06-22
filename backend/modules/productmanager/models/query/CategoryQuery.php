<?php

namespace backend\modules\productmanager\models\query;
class CategoryQuery extends \soft\db\ActiveQuery
{

    public function active()
    {
        return $this->andWhere(['disabled' => 0, 'active' => 1, 'status' => 1]);
    }


}