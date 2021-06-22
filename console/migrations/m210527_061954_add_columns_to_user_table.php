<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210527_061954_add_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'family', 'integer');
        $this->addColumn('user', 'work', 'string');
        $this->addColumn('user', 'profession', 'string');
        $this->addColumn('user', 'experience', 'integer');
        $this->addColumn('user', 'salary', 'integer');

        $this->addColumn('user', 'passport_front', 'string');
        $this->addColumn('user', 'passport_back', 'string');
        $this->addColumn('user', 'passport_with_person', 'string');

        $this->addColumn('user', 'card_number', 'string');
        $this->addColumn('user', 'card_expiry', 'string');
        $this->addColumn('user', 'card_phone', 'string');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
