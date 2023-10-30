<?php

use yii\db\Migration;

/**
 * Class m231008_085904_add_timestamp_and_blameable_to_item
 */
class m231029_085904_add_timestamp_and_blameable_to_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%item}}', 'created_at', $this->timestamp()->null());
        $this->addColumn('{{%item}}', 'updated_at', $this->timestamp()->null());
        $this->addColumn('{{%item}}', 'created_by', $this->integer()->null());
        $this->addColumn('{{%item}}', 'updated_by', $this->integer()->null());

        $this->addForeignKey(
            '{{%fk-item-created_by}}',
            '{{%item}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%fk-item-updated_by}}',
            '{{%item}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // delete columns
        $this->dropForeignKey('{{%fk-item-created_by}}', '{{%item}}');
        $this->dropForeignKey('{{%fk-item-updated_by}}', '{{%item}}');
        $this->dropColumn('{{%item}}', 'created_at');
        $this->dropColumn('{{%item}}', 'updated_at');
        $this->dropColumn('{{%item}}', 'created_by');
        $this->dropColumn('{{%item}}', 'updated_by');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231008_085904_add_timestamp_and_blameable_to_item cannot be reverted.\n";

        return false;
    }
    */
}
