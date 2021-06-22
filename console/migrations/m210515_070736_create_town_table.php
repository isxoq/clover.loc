<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%town}}`.
 */
class m210515_070736_create_town_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%town}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'status' => $this->boolean()->defaultValue(false),
            'delivery_price' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->createTable('{{%town_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string()->notNull(),
        ]);

        $this->createIndex('fk_town_created_by', '{{%town}}', 'created_by');
        $this->createIndex('fk_town_updated_by', '{{%town}}', 'updated_by');
        $this->createIndex('fk_town_lang_relation', '{{%town_lang}}', 'owner_id');

        $this->addForeignKey('fk_town_created_by', '{{%town}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_town_updated_by', '{{%town}}', 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_town_lang_relation', '{{%town_lang}}', 'owner_id', '{{%town}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_town_created_by', '{{%town}}');
        $this->dropForeignKey('fk_town_updated_by', '{{%town}}');
        $this->dropForeignKey('fk_town_lang_relation', '{{%town_lang}}');

        $this->dropIndex('fk_town_created_by', '{{%town}}');
        $this->dropIndex('fk_town_updated_by', '{{%town}}');
        $this->dropIndex('fk_town_lang_relation', '{{%town_lang}}');

        $this->dropTable('{{%town_lang}}');
        $this->dropTable('{{%town}}');
    }
}
