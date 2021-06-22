<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210517_053319_add_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->renameColumn('user', 'name', 'first_name');
        $this->addColumn('user', 'last_name', $this->string()->after('first_name'));
        $this->addColumn('user', 'address', $this->string()->after('last_name'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('user', 'first_name', 'name');
        $this->dropColumn('user', 'last_name');
        $this->dropColumn('user', 'address');
    }
}
