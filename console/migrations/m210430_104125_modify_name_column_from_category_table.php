<?php

use yii\db\Migration;

/**
 * Class m210430_104125_modify_name_column_from_category_table
 */
class m210430_104125_modify_name_column_from_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('category', 'name',  $this->string(60) );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210430_104125_modify_name_column_from_category_table cannot be reverted.\n";

        return false;
    }
    */
}
