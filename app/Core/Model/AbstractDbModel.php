<?php
namespace App\Core\Model;


use App\Core\Database\Connection;
use App\Core\Database\Mapper\Query;
use App\Core\Model\Interfaces\DatabaseInterface;
use App\Core\Model\Interfaces\ModelInterface;
use PDO;

abstract class AbstractDbModel extends Query implements ModelInterface, DatabaseInterface
{
    /**
     * @var string
     */
    protected string $tableName;

    /**
     * AbstractDbModel constructor.
     */
    public function __construct()
    {
        parent::__construct(
            $this->tableName,
            Connection::connect()
        );
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->select()
            ->execute()
            ->getArray();
    }

    /**
     * @param array $data
     * @return int
     */
    public function insertData(array $data): int
    {
        $fields = array_keys($data);
        $values = array_values($data);

        return $this->insert($fields, $values);
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function updateData(array $data, int $id): void
    {
        foreach ($data as $field=>$value) {
            $this->update($field, $value)
                ->where("id", $id)
                ->execute();
        }
    }

    /**
     * @param int $id
     */
    public function deleteData(int $id): void
    {
        $this->delete()
            ->where("id", $id)
            ->execute();
    }
}