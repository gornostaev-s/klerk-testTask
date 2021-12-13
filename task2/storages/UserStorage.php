<?php

use \app\storage\StorageInterface;
use \yii\db\Connection;

class UserStorage implements StorageInterface
{
    const TABLE_NAME = 'users';

    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function load()
    {
        return [];
    }

    public function save(array $items)
    {
        $id = $this
            ->connection
            ->createCommand()
            ->insert(self::TABLE_NAME, $items);

        return $id;
    }

    public function delete($id)
    {
        return true;
    }

    public function update($id, array $items)
    {
        return $id;
    }
}