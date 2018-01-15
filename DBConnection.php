<?php

class DBConnection
{
    protected static $db;
    private function __construct() {
        try {
            self::$db = new \PDO('mysql:host=178.251.31.13:3306;dbname=liannela_fsdb', 'liannela_superuser', '6Z0wKRrPyg' );
            //self::$db = new \PDO( 'mysql:host=127.0.0.1:3306;dbname=liannela_fairsoft', 'root', '' );
            self::$db->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        }
        catch (\PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
    public static function getInstance() {
        if (!self::$db) {
            new DBConnection();
        }
        return self::$db;
    }

    public function __destruct() {
        $db=NULL;
    }
}