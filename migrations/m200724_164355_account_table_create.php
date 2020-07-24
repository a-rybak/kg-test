<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200724164355account_table_create
 */
class m200724_164355_account_table_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('account', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255),
            'last_name' => $this->string(255),
            'account_number' => $this->string(34)->unique(),
            'available_amount' => $this->integer()->defaultValue(0),
            'locked_amount' => $this->integer()->defaultValue(0),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('account');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200724164355account_table_create cannot be reverted.\n";

        return false;
    }
    */
}
