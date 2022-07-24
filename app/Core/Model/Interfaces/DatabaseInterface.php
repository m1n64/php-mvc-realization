<?php
namespace App\Core\Model\Interfaces;


interface DatabaseInterface
{
    /**
     * @return array
     */
    public function getData() : array;

    /**
     * @param array $data
     * @return int
     */
    public function insertData(array $data) : int;

    /**
     * @param array $data
     * @param int $id
     */
    public function updateData(array $data, int $id) : void;

    /**
     * @param int $id
     */
    public function deleteData(int $id) : void;
}