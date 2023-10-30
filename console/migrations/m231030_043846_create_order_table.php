<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m231030_043846_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'customer_id' => $this->integer()->notNull(),
        ]);
        // foreign key
        $this->addForeignKey(
            'fk_order_customer_id',
            'order',
            'customer_id',
            'customer',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
