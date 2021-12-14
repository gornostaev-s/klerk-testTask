<?php
namespace app\services;

use app\storages\StorageInterface;

class UserService
{
    private $storage;

    private $items = [];

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function createUser($data)
    {
        $userId = $this->storage->save($data);
    }

    public function remove($id)
    {
        $this->storage->delete($id);
    }

    public function getUsers()
    {
        $this->loadItems();
        return $this->items;
    }

    private function loadItems(){
        $this->items = $this->storage->load();
    }

}