<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_client}}`.
 */
class m210511_114642_create_auth_client_table extends Migration
{
    /**
     * @return bool|void|null
     */
    public function up()
    {

        $this->createTable('auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'source' => $this->string()->notNull(),
            'source_id' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk-auth-user_id-user-id', 'auth', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @return bool|void|null
     */
    public function down()
    {
        $this->dropTable('auth');

    }
}
