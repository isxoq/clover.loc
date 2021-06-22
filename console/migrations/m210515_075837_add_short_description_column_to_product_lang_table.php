<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product_lang}}`.
 */
class m210515_075837_add_short_description_column_to_product_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product_lang}}', 'short_description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product_lang}}', 'short_description');
    }
}
