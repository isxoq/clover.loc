<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscribe_email}}`.
 */
class m210601_081158_create_subscribe_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subscribe_email}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subscribe_email}}');
    }
}
