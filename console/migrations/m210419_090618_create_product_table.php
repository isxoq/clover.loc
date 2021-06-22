<?php

use soft\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210419_090618_create_product_table extends Migration
{
    public $tableName  = 'product';

    public $timestamp = true;

    public $multilingiualAttributes = [ 'name', 'description', 'meta_title', 'meta_description', 'meta_keyword' ];

    public function attributes()
    {
        return [

            'name' => $this->string()->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'description' => $this->text(),
            'price' => $this->integer()->defaultValue(0),
            'old_price' => $this->integer()->defaultValue(0),
            'order_count' => $this->integer()->defaultValue(0),
            'meta_title' => $this->string(),
            'meta_description' => $this->text(),
            'meta_keyword' => $this->string(),


        ];
    }


}
