<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m210504_053735_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'status' => $this->boolean()->defaultValue(false),
            'image' => $this->string(),
            'small_image' => $this->string(),
            'published_at' => $this->integer(),
            'category_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->createTable('{{%post_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string()->notNull(),
            'short_description' => $this->text(),
            'content' => $this->text(),
        ]);

        $this->createIndex('fk_post_category_id', '{{%post}}', 'category_id');
        $this->createIndex('fk_post_created_by', '{{%post}}', 'created_by');
        $this->createIndex('fk_post_updated_by', '{{%post}}', 'updated_by');
        $this->createIndex('fk_post_lang_relation', '{{%post_lang}}', 'owner_id');

        $this->addForeignKey('fk_post_category_id', '{{%post}}', 'category_id', '{{%post_category}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_post_created_by', '{{%post}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_post_updated_by', '{{%post}}', 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_post_lang_relation', '{{%post_lang}}', 'owner_id', '{{%post}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('fk_post_category_id', '{{%post}}');
        $this->dropForeignKey('fk_post_created_by', '{{%post}}');
        $this->dropForeignKey('fk_post_updated_by', '{{%post}}');
        $this->dropForeignKey('fk_post_lang_relation', '{{%post_lang}}');

        $this->dropIndex('fk_post_category_id', '{{%post}}');
        $this->dropIndex('fk_post_created_by', '{{%post}}');
        $this->dropIndex('fk_post_updated_by', '{{%post}}');
        $this->dropIndex('fk_post_lang_relation', '{{%post_lang}}');

        $this->dropTable('{{%post_lang}}');
        $this->dropTable('{{%post}}');
    }
}
