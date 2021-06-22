<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wishlist}}`.
 */
class m210510_045248_create_wishlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_wishlist_user_id', '{{%wishlist}}');
        $this->dropForeignKey('fk_wishlist_product_id', '{{%wishlist}}');

        $this->dropTable('{{%wishlist}}');
    }
}
