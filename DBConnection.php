<?php

class DBConnection
{
    protected static $db;
    private function __construct() {
        try {
            self::$db = new \PDO( 'mysql:host=185.10.99.6:3306;dbname=sightvision_fairsoft', 'sightvision_fsUser', '82T0ki9di' );
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