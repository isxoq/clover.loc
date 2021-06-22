<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m210426_045034_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [

            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'phone' => $this->string()->notNull(),
            'payment_type' => $this->tinyInteger(2)->defaultValue(1),
            'status' => $this->tinyInteger(2)->defaultValue(1),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ]);


        $this->createTable('{{%order_item}}', [

            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'amount' => $this->smallInteger(),
            'price' => $this->integer(),


        ]);

        $this->createIndex('index_order_user_id', 'order', 'user_id');
        $this->addForeignKey('fk_order_user_id', 'order', 'user_id', 'user', 'id', 'NO ACTION', 'CASCADE');

        $this->createIndex('index_order_item_order_id', 'order_item', 'order_id');
        $this->addForeignKey('fk_order_item_order_id', 'order_item', 'order_id', 'order', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('index_product_product_id', 'order_item', 'product_id');
        $this->addForeignKey('fk_product_id', 'order_item', 'product_id', 'product', 'id', 'CASCADE', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_order_user_id', 'order');
        $this->dropIndex('index_order_user_id', 'order');

        $this->dropForeignKey('fk_order_item_order_id', 'order_item');
        $this->dropIndex('index_order_item_order_id', 'order_item');

        $this->dropForeignKey('fk_product_id', 'order_item');
        $this->dropIndex('index_product_product_id', 'order_item');

        $this->dropTable('{{%order}}');
        $this->dropTable('{{%order_item}}');
    }
}
