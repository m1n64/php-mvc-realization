<?php
namespace App\Models;


use App\Core\Model\AbstractDbModel;

class UserIp extends AbstractDbModel
{
    protected string $tableName = "users_ip";
}