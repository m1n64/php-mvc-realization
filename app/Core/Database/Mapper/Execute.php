<?php
namespace App\Core\Database\Mapper;


use App\Core\Database\Connection;
use App\Core\Database\Mapper\Query\Identifications;
use PDO;

final class Execute
{
    /**
     * @var string
     */
    protected string $sql = "";

    /**
     * @var PDO
     */
    protected PDO $connection;

    /**
     * @var int
     */
    protected int $type;

    /**
     * Execute constructor.
     * @param string $sql
     * @param PDO $connection
     * @param int $type
     */
    public function __construct(
        string $sql,
        PDO $connection,
        int $type = Identifications::TYPE_SELECT
    )
    {
        $this->sql = $sql;
        $this->connection = $connection;
        $this->type = $type;
    }

    /**
     * @return DataObject
     */
    public function execute(): ?DataObject
    {
        try {
            $this->connection->beginTransaction();

            $answer = $this->connection->prepare($this->sql);
            $answer->execute();

            $lastId = $this->connection->lastInsertId();

            $this->connection->commit();

            if ($this->type == Identifications::TYPE_SELECT) {
                return new DataObject(
                    $answer->fetchAll(PDO::FETCH_ASSOC)
                );
            }

            return new DataObject(
                ["id"=>$lastId]
            );
        } catch (\PDOException $ex)
        {
            $this->connection->rollBack();
            throw new \PDOException($ex);
        }
    }

}