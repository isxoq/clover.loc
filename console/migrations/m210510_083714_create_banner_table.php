<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banner}}`.
 */
class m210510_083714_create_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string()->notNull(),
            'is_right' => $this->boolean()->defaultValue(false),
            'status' => $this->tinyInteger(1)->notNull(),
            'url' => $this->string(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
        $this->createTable('{{%banner_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(150)->notNull(),
            'description' => $this->string()->notNull(),
            'text1' => $this->string(100)->notNull(),
            'text2' => $this->string(100),
            'urlName' => $this->string(30)->notNull(),
        ]);
        $this->addForeignKey('fk_banner_lang', '{{%banner_lang}}', 'owner_id', '{{%banner}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_banner_lang','{{%banner_lang}}');
        $this->dropTable('{{%banner_lang}}');
        $this->dropTable('{{%banner}}');
    }
}
