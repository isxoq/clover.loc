<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banner_group}}`.
 */
class m210517_065506_create_banner_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner_group}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(),
            'button_url1' => $this->string(255),
            'button_url2' => $this->string(255),
            'status' => $this->tinyInteger(1)->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
        $this->createTable('{{%banner_group_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(150),
            'content' => $this->string(255),
            'button_label1' => $this->string(100),
            'button_label2' => $this->string(100),
        ]);

        $this->addForeignKey('fk_banner_group_lang','{{%banner_group_lang}}','owner_id','{{%banner_group}}','id','CASCADE','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_banner_group_lang','{{%banner_group_lang}}');
        $this->dropTable('{{%banner_group_lang}}');
        $this->dropTable('{{%banner_group}}');
    }
}
