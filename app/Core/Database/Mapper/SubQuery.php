<?php
namespace App\Core\Database\Mapper;


use App\Core\Database\Mapper\Query\Cleanup;
use App\Core\Database\Mapper\Query\Identifications;
use PDO;

final class SubQuery
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
     * @var string
     */
    protected string $tableName;

    /**
     * @var int
     */
    protected int $type;

    /**
     * SubQuery constructor.
     * @param string $sql
     * @param PDO $connection
     * @param string $tableName
     * @param int $type
     */
    public function __construct(
        string $sql,
        PDO $connection,
        string $tableName,
        int $type = Identifications::TYPE_SELECT
    )
    {
        $this->sql = $sql;
        $this->connection = $connection;
        $this->tableName = $tableName;
        $this->type = $type;
    }

    /**
     * @param string $field
     * @param $value
     * @param string $operand
     * @return $this
     */
    public function where(string $field, $value, string $operand = "=") : SubQuery
    {
        if (is_string($value)) {
            $value = $this->connection->quote(Cleanup::cleanQuotes($value));
        }

        $this->sql .= " WHERE ".
            Cleanup::cleanQuotes($field)." ".
            Cleanup::cleanQuotes($operand)." ".
            $value;

        return $this;
    }

    /**
     * @param string $field
     * @param string $type
     * @return $this
     */
    public function orderBy(string $field, string $type = "DESC") : SubQuery
    {
        $this->sql .= " ORDER BY ".Cleanup::cleanQuotes($field)." ".$type;

        return $this;
    }

    /**
     * @param string $table
     * @param string $tableField
     * @param string $field
     * @param string $operand
     * @return $this
     */
    public function join(string $table, string $tableField, string $field, string $operand = "=") : SubQuery
    {
        $this->sql .= " INNER JOIN ".
            Cleanup::cleanQuotes($table)." ON ".
            Cleanup::cleanQuotes($table).".".Cleanup::cleanQuotes($tableField)." ".
            $operand." ".
            Cleanup::cleanQuotes($this->tableName).".".Cleanup::cleanQuotes($field);

        return $this;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return $this
     */
    public function limit(int $limit, int $offset = 0): SubQuery
    {
        $this->sql .= " LIMIT $limit OFFSET $offset";

        return $this;
    }

    /**
     * @return DataObject|null
     */
    public function execute(): ?DataObject
    {
        $executor = new Execute(
            $this->sql,
            $this->connection,
            $this->type
        );

        return $executor->execute();
    }
}