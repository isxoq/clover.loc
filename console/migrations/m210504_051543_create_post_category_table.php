<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_category}}`.
 */
class m210504_051543_create_post_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_category}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('{{%post_category_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'name' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk_post_category_lang', '{{%post_category_lang}}', 'owner_id', '{{%post_category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_category_lang', '{{%post_category_lang}}');
        $this->dropTable('{{%post_category_lang}}');
        $this->dropTable('{{%post_category}}');
    }
}
