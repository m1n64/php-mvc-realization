<?php
namespace App\Core\Model\Interfaces;


interface FileInterface
{
    /**
     * @param string $file
     * @return string
     */
    public function getData(string $file) : string;

    /**
     * @param string $file
     * @param string $data
     */
    public function setData(string $file, string $data) : void;
}