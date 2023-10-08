<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%statistic}}`.
 */
class m231008_072654_create_statistic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%statistic}}', [
            'id' => $this->primaryKey(),
            'access_time' => $this->integer()->notNull(),
            'user_ip' => $this->string(20)->notNull(),
            'user_host' => $this->string(255)->notNull(),
            'path_info' => $this->string(255)->notNull(),
            'query_string' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%statistic}}');
    }
}
