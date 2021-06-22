<?php

use soft\db\Migration;

/**
 * Handles the creation of table `{{%product_character_assign}}`.
 */
class m210421_054655_create_product_character_assign_table extends Migration
{

    public $tableName = 'product_character_assign';

    public $multilingiualAttributes = ['value'];

    public $foreignKeys = [
        [
            'name' => 'fk_character',
            'columns' => 'character_id',
            'refTable' => 'character',
        ],

        [
            'name' => 'fk_product',
            'columns' => 'product_id',
            'refTable' => 'product',
        ],
    ];

    public function attributes()
    {
        return [
            'value' => $this->string()->notNull(),
            'sort_order' => $this->smallInteger(4)->defaultValue(999),
            'character_id' => $this->integer(),
            'product_id' => $this->integer(),

        ];
    }

}
