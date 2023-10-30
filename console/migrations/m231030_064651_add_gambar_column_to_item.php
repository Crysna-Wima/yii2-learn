<?php

use yii\db\Migration;

/**
 * Class m231030_064651_add_gambar_column_to_item
 */
class m231030_064651_add_gambar_column_to_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item', 'gambar', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231030_064651_add_gambar_column_to_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231030_064651_add_gambar_column_to_item cannot be reverted.\n";

        return false;
    }
    */
}
