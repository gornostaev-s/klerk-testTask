<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m211211_135757_usersTable
 */
class m211211_135757_usersTable extends Migration
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

        $this->createTable('{{%users}}',[
            'id' => $this->primaryKey(),
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'surname' => Schema::TYPE_STRING . ' NOT NULL',
            'patronymic' => Schema::TYPE_STRING . ' NOT NULL',
            'updated_by' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT NOW()',
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
