<?php

use soft\db\Migration;

/**
 * Handles the creation of table `{{%character_group}}`.
 */
class m210419_111317_create_character_group_table extends Migration
{

    public $tableName = 'character_group';

    public $multilingiualAttributes = ['name'];

    public function attributes()
    {
        return [
            'name' => $this->string()->notNull(),
            'sort_order' => $this->smallInteger(4)->defaultValue(999),

        ];
    }


}
