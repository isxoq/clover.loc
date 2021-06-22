<?php

use yii\db\Migration;

/**
 * Class m210519_060126_add_fields_to_order_table
 */
class m210519_060126_add_fields_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'shipping_method', 'integer');
        $this->addColumn('order', 'total_amount', 'integer');
        $this->addColumn('order', 'full_name', 'string');
        $this->addColumn('order', 'notes', 'text');
        $this->addColumn('order', 'zip', 'string');
        $this->addColumn('order', 'address', 'text');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order', 'shipping_method');
        $this->dropColumn('order', 'total_amount');
        $this->dropColumn('order', 'full_name');
        $this->dropColumn('order', 'notes');
        $this->dropColumn('order', 'zip');
        $this->dropColumn('order', 'address');
    }


}
