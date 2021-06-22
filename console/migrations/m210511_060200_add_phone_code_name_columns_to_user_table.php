<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210511_060200_add_phone_code_name_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone', 'string');
        $this->addColumn('user', 'name', 'string');
        $this->addColumn('user', 'code', 'integer');
        $this->addColumn('user', 'verify_time', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone');
        $this->dropColumn('user', 'code');
        $this->dropColumn('user', 'name');
        $this->dropColumn('user', 'verify_time');
    }
}
