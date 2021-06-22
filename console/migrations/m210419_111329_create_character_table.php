<?php

use soft\db\Migration;

/**
 * Handles the creation of table `{{%character}}`.
 */
class m210419_111329_create_character_table extends Migration
{
    public $tableName = 'character';

    public $multilingiualAttributes = ['name'];

    public $foreignKeys = [
        [
            'columns' => 'group_id',
            'refTable' => 'character_group',
            'delete' => 'SET NULL',
        ]
    ];

    public function attributes()
    {
        return [
            'name' => $this->string()->notNull(),
            'sort_order' => $this->smallInteger(4)->defaultValue(999),
            'group_id' => $this->integer(),

        ];
    }
}
