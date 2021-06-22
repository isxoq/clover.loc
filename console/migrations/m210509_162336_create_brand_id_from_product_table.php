<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%brand_id_from_product}}`.
 */
class m210509_162336_create_brand_id_from_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product','brand_id',$this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      return true;
    }
}
