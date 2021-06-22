<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faq}}`.
 */
class m210506_183427_create_faq_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%faq}}', [
            'id' => $this->primaryKey(),
            'status' => $this->tinyInteger(1)->notNull(),
            'faq_type_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
        $this->createTable('{{%faq_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'question' => $this->string()->notNull(),
            'asked' => $this->text()->notNull(),
        ]);
        $this->addForeignKey('fk_faq_lang','{{%faq_lang}}','owner_id','{{%faq}}','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_faq_lang','{{%faq_lang}}');
        $this->dropTable('{{%faq_lang}}');
        $this->dropTable('{{%faq}}');
    }
}
