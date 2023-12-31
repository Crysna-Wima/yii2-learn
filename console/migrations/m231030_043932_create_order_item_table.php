<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_item}}`.
 */
class m231030_043932_create_order_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
        ]);
        // foreign key
        $this->addForeignKey(
            'fk_order_item_order_id',
            'order_item',
            'order_id',
            'order',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_order_item_item_id',
            'order_item',
            'item_id',
            'item',
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
        $this->dropTable('{{%order_item}}');
    }
}
