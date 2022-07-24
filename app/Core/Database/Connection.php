<?php
namespace App\Core\Database;

use PDO;

final class Connection
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (is_null(self::$connection)) {
            $type = getenv("DB_VENDOR");
            $host = getenv("DB_HOST");
            $db = getenv("DB_NAME");
            $user = getenv("DB_USER");
            $pass = getenv("DB_PASSWORD");

            self::$connection = new PDO($type.':host='.$host.';dbname='.$db, $user, $pass, [PDO::ATTR_STRINGIFY_FETCHES => false, PDO::ATTR_EMULATE_PREPARES => false]);
        }

        return self::$connection;
    }

    private function __construct() {}
}