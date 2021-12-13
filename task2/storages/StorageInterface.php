<?php

namespace app\storage;

interface StorageInterface
{
    /**
     * @return array
     */
    public function load();

    /**
     * @param array
     */
    public function save(array $items);
    /**
     * @param int
     */
    public function delete($id);
    /**
     * @param int
     * @param array
     */
    public function update($id, array $items);

}