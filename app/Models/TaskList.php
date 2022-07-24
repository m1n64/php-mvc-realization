<?php
namespace App\Models;

use App\Core\Model\AbstractDbModel;

class TaskList extends AbstractDbModel
{
    protected string $tableName = "todo_list";
}