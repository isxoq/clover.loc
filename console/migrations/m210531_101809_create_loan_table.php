<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%loan}}`.
 */
class m210531_101809_create_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%loan}}', [

            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'card_number' => $this->string(),
            'card_expiry' => $this->string(),
            'card_phone' => $this->string(),
            'product_id' => $this->integer(),
            'loan_price' => $this->integer(),
            'first_payment' => $this->integer(),
            'month' => $this->integer(),
            'created_date' => $this->integer(),
            'status' => $this->integer()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%loan}}');
    }
}
