<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faq_type}}`.
 */
class m210506_182439_create_faq_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%faq_type}}', [
            'id' => $this->primaryKey(),
            'status' => $this->tinyInteger(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
        $this->createTable('{{%faq_type_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'name' => $this->string()->notNull(),
        ]);
        $this->addForeignKey('fk_faq_type', '{{%faq_type_lang}}', 'owner_id', '{{%faq_type}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_faq_type','{{%faq_type_lang}}');
        $this->dropTable('{{%faq_type_lang}}');
        $this->dropTable('{{%faq_type}}');
    }
}
