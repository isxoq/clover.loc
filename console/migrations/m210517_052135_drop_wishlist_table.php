<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%wishlist}}`.
 */
class m210517_052135_drop_wishlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_wishlist_user_id', '{{%wishlist}}');
        $this->dropForeignKey('fk_wishlist_product_id', '{{%wishlist}}');

        $this->dropTable('{{%wishlist}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%wishlist}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer(),
            'created_at' => $this->integer(),
        ]);

        $this->addForeignKey('fk_wishlist_user_id', '{{%wishlist}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_wishlist_product_id', '{{%wishlist}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
    }
}
