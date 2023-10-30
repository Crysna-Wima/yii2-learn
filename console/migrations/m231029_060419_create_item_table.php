<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m231029_060419_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'price' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
        // foreign key
        $this->addForeignKey(
            'fk_item_category_id',
            'item',
            'category_id',
            'item_category',
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
        $this->dropTable('{{%item}}');
    }
}
