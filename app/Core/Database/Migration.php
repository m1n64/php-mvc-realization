<?php
namespace App\Core\Database;


final class Migration
{
    /**
     * @param string $table
     * @param array $fields
     * @return string|null
     */
    public static function create(string $table, array $fields) : ?string
    {
        try {
            $connection = Connection::connect();

            $params = "id int NOT NULL AUTO_INCREMENT,";
            foreach ($fields as $key => $value) {
                $params .= $key . " " . $value . ", ";
            }
            $params .= "PRIMARY KEY (id)";

            $sql = "CREATE TABLE $table(
                $params   
            );";

            $connection->query($sql)
                ->execute();

            return "ok";
        } catch (\PDOException $error) {
            return "Error: ".$error->getMessage();
        }
    }

    private function __construct() {}
}