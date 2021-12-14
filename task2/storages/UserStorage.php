<?php
namespace app\storages;

use \app\storages\StorageInterface;
use \yii\db\Connection;

class UserStorage implements StorageInterface
{
    const USERS_TABLE = 'users';
    const PHONES_TABLE = 'phones';


    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function load()
    {
        return [];
    }

    public function save(array $item)
    {

        $phones = $item['phones'];
        unset($item['phones']);

         $this
            ->connection
            ->createCommand()
            ->insert(self::USERS_TABLE, $item);

        $id = $this
            ->connection
            ->lastInsertID;

        $this
            ->savePhones($id, $phones);

    }

    public function delete($id)
    {
        return true;
    }

    public function update($id, array $items)
    {
        return $id;
    }

    protected function savePhones($userId, array $phones)
    {
        foreach ($phones as $phone){

            $data = [
                'user_id' => $userId,
                'phone' => $phone
            ];

            $this
                ->connection
                ->createCommand()
                ->insert(self::PHONES_TABLE, $data);
        }
    }
}