<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service}}`.
 */
class m210501_074910_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'icon' => $this->string(100)->notNull(),
            'status' => $this->boolean(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        $this->createTable('{{%service_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6),
            'title' => $this->string(100)->notNull(),
            'content' => $this->string(150),

        ]);

        $this->addForeignKey('fk_service_lang','{{%service_lang}}','owner_id','{{%service}}','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_service_lang','{{%service_lang}}');
        $this->dropTable('{{%service_lang}}');
        $this->dropTable('{{%service}}');
    }
}
