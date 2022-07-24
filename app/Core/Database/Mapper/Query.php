<?php
namespace App\Core\Database\Mapper;

use App\Core\Database\Connection;
use App\Core\Database\Mapper\Query\Cleanup;
use App\Core\Database\Mapper\Query\Identifications;
use PDO;

class Query
{
    /**
     * @var string
     */
    protected string $tableName = "";

    /**
     * @var PDO
     */
    protected PDO $connection;

    /**
     * Query constructor.
     * @param string $tableName
     * @param PDO $connection
     */
    public function __construct(
        string $tableName,
        PDO $connection
    )
    {
        $this->tableName = $tableName;
        $this->connection = $connection;
    }

    /**
     * @param array $fields
     * @return SubQuery
     */
    public function select(array $fields = []) : SubQuery
    {
        $sql = "SELECT ". (count($fields) == 0 ? "*" : implode(", ", $fields))." ".
               "FROM ".Cleanup::cleanQuotes($this->tableName) ;

        return new SubQuery(
            $sql,
            $this->connection,
            $this->tableName,
            Identifications::TYPE_SELECT
        );
    }

    /**
     * @param array $fields
     * @param array $values
     * @return int
     */
    public function insert(array $fields, array $values) : int
    {
        [$fields, $values] = $this->formatQuery($fields, $values);

        $sql = "INSERT INTO ".Cleanup::cleanQuotes($this->tableName).
            "($fields)"." VALUES".
            "($values)";

        $executor = new Execute(
            $sql,
            $this->connection,
            Identifications::TYPE_INSERT
        );

        return $executor->execute()
            ->getObject()->id;
    }

    /**
     * @param string $field
     * @param $value
     * @return SubQuery
     */
    public function update(string $field, $value): SubQuery
    {
        if (is_string($value)) {
            $value = $this->connection->quote($value);
        }

        $sql = "UPDATE ".Cleanup::cleanQuotes($this->tableName)." SET ".
            Cleanup::cleanQuotes($field)." = ".$value;

        return new SubQuery(
            $sql,
            $this->connection,
            $this->tableName,
            Identifications::TYPE_INSERT
        );
    }

    /**
     * @return SubQuery
     */
    public function delete(): SubQuery
    {
        $sql = "DELETE FROM ".Cleanup::cleanQuotes($this->tableName);

        return new SubQuery(
            $sql,
            $this->connection,
            $this->tableName,
            Identifications::TYPE_INSERT
        );
    }

    /**
     * @param $fields
     * @param $values
     * @return array
     */
    private function formatQuery($fields, $values): array
    {
        $newField = "";
        $newValue = "";

        foreach ($fields as $field) {
            $newField .= Cleanup::cleanQuotes($field).",";
        }

        foreach ($values as $value) {
            if (is_string($value)) {
                $newValue .= $this->connection->quote(Cleanup::cleanQuotes($value)).",";
            }
            else {
                $newValue .= $value . ",";
            }
        }

        $newField = substr($newField,0,-1);
        $newValue = substr($newValue,0,-1);

        return [$newField, $newValue];
    }
}