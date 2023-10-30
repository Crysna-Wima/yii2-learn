<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_category}}`.
 */
class m231029_060255_create_item_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'parent_category' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_category}}');
    }
}
