<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m210518_083535_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'image' => $this->string(),
            'status' => $this->tinyInteger(1),
        ]);
        $this->createTable('{{%page_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string()->notNull(),
            'short_description' => $this->text(),
            'content' => $this->text(),
        ]);

        $this->addForeignKey('fk_page_lang', '{{%page_lang}}', 'owner_id', '{{%page}}', 'id', 'CASCADE', 'CASCADE');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_page_lang','{{%page_lang}}');
        $this->dropTable('{{%page_lang}}');
        $this->dropTable('{{%page}}');
    }
}
