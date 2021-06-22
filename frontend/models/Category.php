<?php

namespace frontend\models;

use Yii;
use soft\helpers\Url;

/**
 * @property-read Category[] $subCategories
 * @property-read mixed $detailUrl
 * @property string $image [varchar(150)]
 */
class Category extends \backend\modules\productmanager\models\Category
{

    public static $productClassName = 'frontend\models\Product';

    public function rules()
    {
        return [];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['timestamp']);
        unset($behaviors['slug']);
        unset($behaviors['parentId']);
        return $behaviors;
    }

    public function getDetailUrl()
    {
        return Url::to(['product/category', 'slug' => $this->slug]);
    }

    /**
     * Bosh sahifa uchun Categoriyalarni limit 4 ta sini olib beradi
     * @return Category[]
     */
    public static function activeMainProductCategories()
    {
        return Yii::$app->db->cache(function () {

            return static::findMainCategories()
                ->andWhere(['status' => 1])
                ->with('activeSubCategories')
                ->limit(4)
                ->all();
        });
    }


}