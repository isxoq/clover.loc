<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recommended_category}}`.
 */
class m210518_041206_create_recommended_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recommended_category}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'image' => $this->string(),
            'url' => $this->string(),
            'status' => $this->tinyInteger(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
        $this->createTable('{{%recommended_category_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'text1' => $this->string(),
            'text2' => $this->string(),
            'text3' => $this->string(),
            'button_label' => $this->string(),
        ]);

        $this->addForeignKey('fk_recommended_category_lang', '{{%recommended_category_lang}}', 'owner_id', '{{%recommended_category}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_recommended_category_id', '{{%recommended_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_recommended_category_id','{{%recommended_category}}');
        $this->dropForeignKey('fk_recommended_category_lang','{{%recommended_category_lang}}');
        $this->dropTable('{{%recommended_category_lang}}');
        $this->dropTable('{{%recommended_category}}');
    }
}
