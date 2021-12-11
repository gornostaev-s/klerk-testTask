<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m211211_135819_phonesTable
 */
class m211211_135819_phonesTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%phones}}',[
            'id' => $this->primaryKey(),
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'phone' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%phones}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211211_135819_phonesTable cannot be reverted.\n";

        return false;
    }
    */
}
